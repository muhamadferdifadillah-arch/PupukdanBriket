<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();

        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $user->id)
            ->select(
                'c.product_id',
                'c.quantity',
                'p.name',
                'p.image',
                'p.price'
            )
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $tax = $subtotal * 0.10;
        $shipping = 0;
        $total = $subtotal + $tax + $shipping;

        return view('user.checkout', compact(
            'user',
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total'
        ));
    }

    public function process(Request $request)
    {
        // ✅ DEBUGGING: Log semua input
        Log::info('=== CHECKOUT PROCESS START ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request Data:', $request->all());

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'district' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:10',
            'courier' => 'required|in:jne,jnt,sicepat',
            'payment_method' => 'required|in:cash,transfer,e-wallet',
            'shipping_cost' => 'required|numeric|min:1',
        ]);

        Log::info('Validation passed');

        $userId = Auth::id();

        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select(
                'cart.product_id',
                'cart.quantity',
                'products.name',
                'products.price',
                'products.image'
            )
            ->get();

        Log::info('Cart items count: ' . $cartItems->count());

        if ($cartItems->isEmpty()) {
            Log::warning('Cart is empty for user: ' . $userId);
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong, tidak dapat checkout');
        }

        $subtotal = $cartItems->sum(fn ($i) => $i->price * $i->quantity);
        $tax = $subtotal * 0.1;
        $shipping = (int) $request->shipping_cost;
        $total = $subtotal + $tax + $shipping;

        Log::info('Calculations:', [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total
        ]);

        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(substr(uniqid(), -4));
            
            Log::info('Inserting order with number: ' . $orderNumber);

            // ✅ INSERT ORDER
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'customer_name' => $validated['full_name'],
                'customer_phone' => $validated['phone'],
                'shipping_address' => $validated['address'],
                'district' => $validated['district'] ?? null,
                'postal_code' => $validated['postal_code'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shipping,
                'total_amount' => $total,
                'payment_method' => $validated['payment_method'],
                'courier' => $validated['courier'],
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Order inserted with ID: ' . $orderId);

            // ✅ INSERT ORDER ITEMS
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_image' => $item->image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Log::info('Order items inserted');

            // ✅ DELETE CART
            $deletedRows = DB::table('cart')->where('user_id', $userId)->delete();
            Log::info('Cart cleared, deleted rows: ' . $deletedRows);

            DB::commit();

            Log::info('=== CHECKOUT PROCESS SUCCESS ===');

            return redirect()->route('user.orders.index')
                ->with('success', 'Pesanan berhasil dibuat! Order: ' . $orderNumber);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('=== CHECKOUT PROCESS FAILED ===');
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

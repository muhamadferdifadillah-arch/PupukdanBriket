<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Halaman checkout
    public function index()
    {
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
            return redirect()->route('cart.index');
        }

        // HITUNG ULANG SUBTOTAL
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shipping = 15000; // ongkir (bisa dinamis nanti)
        $total = $subtotal + $shipping;

        return view('user.checkout', compact(
            'user',
            'cartItems',
            'subtotal',
            'shipping',
            'total'
        ));
    }

    // Proses checkout
    public function process(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'courier' => 'required',
            'payment_method' => 'required',
        ]);

        $userId = Auth::id();

        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $userId)
            ->select(
                'c.product_id',
                'c.quantity',
                'p.name',
                'p.image',
                'p.price'
            )
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        // HITUNG ULANG TOTAL (ANTI MANIPULASI)
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shipping = (int) $request->shipping_cost;
        $totalAmount = $subtotal + $shipping;


        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'customer_name' => $request->full_name,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->address,
                'total_amount' => $totalAmount,
                'shipping_cost' => $shipping,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_image' => $item->image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                ]);
            }

            DB::table('cart')->where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('user.orders.index')
                ->with('success', 'Pesanan berhasil dibuat');


        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan');
        }
    }

    public function success($orderNumber)
    {
        $order = DB::table('orders')
            ->where('order_number', $orderNumber)
            ->first();

        if (!$order) {
            return redirect()->route('cart.index');
        }

        return view('user.order-success', compact('order'));
    }
}

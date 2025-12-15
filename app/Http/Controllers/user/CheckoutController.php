<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $user->id)
            ->select('c.product_id', 'c.quantity', 'p.name', 'p.image', 'p.price')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->price * $i->quantity);
        $tax = $subtotal * 0.10;
        $shipping = 0;
        $total = $subtotal + $tax;

        return view('user.checkout', compact('user', 'cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
        $userId = Auth::id();
        
        // GET CART
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('cart.product_id', 'cart.quantity', 'products.name', 'products.price', 'products.image')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        // CALCULATE
        $subtotal = $cartItems->sum(fn($i) => $i->price * $i->quantity);
        $tax = $subtotal * 0.1;
        $shipping = (int) ($request->shipping_cost ?? 0);
        $total = $subtotal + $tax + $shipping;

        try {
            // INSERT ORDER
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_number' => 'ORD-' . time(),
                'customer_name' => $request->full_name ?? 'Customer',
                'customer_phone' => $request->phone ?? '000',
                'shipping_address' => $request->address ?? 'Address',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shipping,
                'total_amount' => $total,
                'payment_method' => $request->payment_method ?? 'transfer',
                'courier' => $request->courier ?? 'jne',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // INSERT ITEMS
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

            // CLEAR CART
            DB::table('cart')->where('user_id', $userId)->delete();

            return redirect('/')->with('success', 'Pesanan berhasil dibuat! Terima kasih telah berbelanja.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}
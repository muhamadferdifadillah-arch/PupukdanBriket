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
            // HAPUS 'p.category' jika kolom tidak ada
        )
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index');
    }

    // HITUNG SUBTOTAL (harga * quantity)
    $subtotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // HITUNG TAX 10%
    $tax = $subtotal * 0.10;

    // ONGKIR default 0 (akan diupdate via JavaScript)
    $shipping = 0;

    // TOTAL = Subtotal + Tax + Shipping
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
            'shipping_cost' => 'required|numeric', // validasi shipping
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
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        // HITUNG ULANG TOTAL (ANTI MANIPULASI)
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // HITUNG TAX 10%
        $tax = $subtotal * 0.10;

        // AMBIL SHIPPING DARI REQUEST
        $shipping = (int) $request->shipping_cost;

        // TOTAL = Subtotal + Tax + Shipping
        $totalAmount = $subtotal + $tax + $shipping;

        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'customer_name' => $request->full_name,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->address,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shipping,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'courier' => $request->courier,
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

            // Hapus cart setelah order berhasil
            DB::table('cart')->where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('user.orders.index')
                ->with('success', 'Pesanan berhasil dibuat dengan nomor: ' . $orderNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($orderNumber)
    {
        $order = DB::table('orders')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('cart.index');
        }

        $orderItems = DB::table('order_items')
            ->where('order_id', $order->id)
            ->get();

        return view('user.order-success', compact('order', 'orderItems'));
    }
}
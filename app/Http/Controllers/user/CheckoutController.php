<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Tampilkan halaman checkout
    public function index()
    {
        $userId = Auth::id();
        $user = Auth::user();
        
        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $userId)
            ->select('c.*', 'p.name', 'p.image')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }
        
        $total = $cartItems->sum('subtotal');
        
        return view('user.checkout', compact('user', 'cartItems', 'total'));
    }
    
    // Proses checkout
    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required'
        ]);
        
        $userId = Auth::id();
        
        // Generate order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        
        // Ambil cart items
        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $userId)
            ->select('c.*', 'p.name', 'p.image')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }
        
        $totalAmount = $cartItems->sum('subtotal');
        
        DB::beginTransaction();
        
        try {
            // Insert order
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Insert order items
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_image' => $item->image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal
                ]);
            }
            
            // Hapus cart
            DB::table('cart')->where('user_id', $userId)->delete();
            
            DB::commit();
            
            return redirect()->route('order.success', ['order_number' => $orderNumber]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan');
        }
    }
    
    // Halaman order sukses
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
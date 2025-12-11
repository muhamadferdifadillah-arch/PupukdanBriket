<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // LIST MY ORDERS
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id());

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('order_number', 'like', '%'.$request->search.'%');
        }

        $orders = $query->latest()->paginate(10);

        return view('user.order-user', compact('orders'));
    }

    // BAYAR PESANAN
    public function pay($id)
    {
        return "Halaman pembayaran untuk order ID: " . $id;
    }

    // TERIMA PESANAN
    public function complete($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $order->status = 'completed';
        $order->save();

        return back()->with('success', 'Pesanan telah diterima!');
    }

    // BATALKAN PESANAN
    public function cancel($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}

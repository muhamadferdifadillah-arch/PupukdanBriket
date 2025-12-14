<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        $query = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', '%' . $search . '%')
                  ->orWhere('customer_name', 'like', '%' . $search . '%');
            });
        }

        $orders = $query->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = DB::table('orders')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('user.orders.index')
                ->with('error', 'Pesanan tidak ditemukan');
        }

        $orderItems = DB::table('order_items')
            ->where('order_id', $order->id)
            ->get();

        return view('user.orders.show', compact('order', 'orderItems'));
    }

    public function complete($id)
    {
        try {
            $updated = DB::table('orders')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->where('status', 'shipped')
                ->update([
                    'status' => 'completed',
                    'updated_at' => now()
                ]);

            if ($updated) {
                Log::info('Order completed', ['order_id' => $id, 'user_id' => Auth::id()]);
                return redirect()->back()->with('success', 'Pesanan berhasil diselesaikan!');
            }

            return redirect()->back()->with('error', 'Gagal menyelesaikan pesanan.');

        } catch (\Exception $e) {
            Log::error('Complete order error', ['order_id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function cancel($id)
    {
        try {
            $updated = DB::table('orders')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->where('status', 'pending')
                ->update([
                    'status' => 'cancelled',
                    'updated_at' => now()
                ]);

            if ($updated) {
                Log::info('Order cancelled', ['order_id' => $id, 'user_id' => Auth::id()]);
                return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
            }

            return redirect()->back()->with('error', 'Gagal membatalkan pesanan.');

        } catch (\Exception $e) {
            Log::error('Cancel order error', ['order_id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function pay($id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$order) {
            return redirect()->route('user.orders.index')
                ->with('error', 'Pesanan tidak ditemukan atau sudah dibayar');
        }

        return view('user.orders.payment', compact('order'));
    }
}
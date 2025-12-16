<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan user
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // ✅ AMBIL STATUS DARI REQUEST (default: 'all')
        $status = $request->get('status', 'all');
        
        // Query orders
        $query = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc');

        // ✅ FILTER BY STATUS
        if ($status !== 'all' && in_array($status, ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])) {
            $query->where('status', $status);
        }

        // ✅ SEARCH FUNCTIONALITY
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', '%' . $search . '%')
                  ->orWhere('customer_name', 'like', '%' . $search . '%');
            });
        }

        // ✅ GET RESULTS
        $orders = $query->get(); // Bisa juga pakai ->paginate(10) jika mau pagination

        // ✅ PASS $status KE VIEW (INI YANG PENTING!)
        return view('user.orders.index', compact('orders', 'status'));
    }

    /**
     * Tampilkan detail pesanan
     */
    public function show($orderNumber)
    {
        $userId = Auth::id();
        
        // ✅ CARI ORDER BERDASARKAN order_number ATAU id
        $order = DB::table('orders')
            ->where('user_id', $userId)
            ->where(function($query) use ($orderNumber) {
                $query->where('order_number', $orderNumber)
                      ->orWhere('id', $orderNumber);
            })
            ->first();

        if (!$order) {
            return redirect()->route('user.orders.index')
                ->with('error', 'Pesanan tidak ditemukan');
        }

        // ✅ AMBIL ORDER ITEMS
        $orderItems = DB::table('order_items')
            ->where('order_id', $order->id)
            ->get();

        return view('user.orders.show', compact('order', 'orderItems'));
    }

    /**
     * ✅ HALAMAN SUCCESS SETELAH CHECKOUT - TAMBAHKAN METHOD INI
     */
    public function orderSuccess($orderNumber)
    {
        $order = DB::table('orders')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('home')
                ->with('error', 'Pesanan tidak ditemukan!');
        }

        return view('user.order-success', compact('order', 'orderNumber'));
    }

    /**
     * Selesaikan pesanan (status: shipped → completed)
     */
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
                return redirect()->route('user.orders.index')
                    ->with('success', 'Pesanan berhasil diselesaikan!');
            }

            return redirect()->back()
                ->with('error', 'Gagal menyelesaikan pesanan. Pastikan status pesanan adalah "Dikirim".');

        } catch (\Exception $e) {
            Log::error('Complete order error', [
                'order_id' => $id, 
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Batalkan pesanan (status: pending → cancelled)
     */
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
                return redirect()->route('user.orders.index')
                    ->with('success', 'Pesanan berhasil dibatalkan!');
            }

            return redirect()->back()
                ->with('error', 'Gagal membatalkan pesanan. Hanya pesanan dengan status "Menunggu Pembayaran" yang bisa dibatalkan.');

        } catch (\Exception $e) {
            Log::error('Cancel order error', [
                'order_id' => $id, 
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman pembayaran
     */
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
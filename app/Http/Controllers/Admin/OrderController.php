<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Halaman riwayat pembelian
    public function index()
    {
        $orders = DB::table('orders as o')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->select('o.*', 'u.name as user_name', 'u.email as user_email')
            ->orderBy('o.created_at', 'desc')
            ->get();
        
        // Statistik
        $stats = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->sum('total_amount'),
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'completed_orders' => $orders->where('status', 'completed')->count()
        ];
        
        return view('admin.orders.index', compact('orders', 'stats'));
    }
    
    // Detail order
    public function detail($id)
    {
        $order = DB::table('orders as o')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->where('o.id', $id)
            ->select('o.*', 'u.name as user_name', 'u.email as user_email')
            ->first();
        
        $orderItems = DB::table('order_items')
            ->where('order_id', $id)
            ->get();
        
        return view('admin.orders.detail', compact('order', 'orderItems'));
    }
    
    // Update status (AJAX)
    public function updateStatus(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->status;
        
        $allowedStatus = ['pending', 'processing', 'completed', 'cancelled'];
        
        if (!in_array($status, $allowedStatus)) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid'
            ]);
        }
        
        DB::table('orders')
            ->where('id', $orderId)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate'
        ]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of purchase history
     */
    public function index()
    {
        $purchases = Order::with(['user', 'orderDetails.product'])
            ->latest()
            ->paginate(15);
        
        // Statistik
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        return view('admin.purchase-history.index', compact(
            'purchases',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'completedOrders'
        ));
    }

    /**
     * Home page - alias untuk index
     */
    public function home()
    {
        return $this->index();
    }

    /**
     * Display the specified purchase detail
     */
    public function show($id)
    {
        $purchase = Order::with(['user', 'orderDetails.product'])
            ->findOrFail($id);
        
        return view('admin.purchase-history.show', compact('purchase'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Status pembelian berhasil diupdate!');
    }
}
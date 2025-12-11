<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $produsenId = Auth::id();
        
        // Total Products by Produsen
        $totalProducts = Product::where('produsen_id', $produsenId)->count();

        // Get current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Orders This Month
        // Orders This Month
    $ordersThisMonth = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->where('products.produsen_id', $produsenId)  // <- UBAH DI SINI
        ->where('orders.status', 'completed')
        ->whereMonth('orders.created_at', $currentMonth)
        ->whereYear('orders.created_at', $currentYear)
        ->distinct()
        ->count('orders.id');

        // Revenue This Month
        $revenueThisMonth = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.produsen_id', $produsenId)
            ->where('orders.status', 'completed')
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->selectRaw('SUM(order_items.price * order_items.quantity) as total')
            ->value('total') ?? 0;

        // Total Revenue (All Time)
        $totalRevenue = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.produsen_id', $produsenId)
            ->where('orders.status', 'completed')
            ->selectRaw('SUM(order_items.price * order_items.quantity) as total')
            ->value('total') ?? 0;

        // Monthly Data
        $monthlyData = [];
        $chartData = [];
        $totalOrders = 0;
        $totalItems = 0;

        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($month = 1; $month <= 12; $month++) {
            // Orders per month
            $orders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('products.produsen_id', $produsenId)
                ->where('orders.status', 'completed')
                ->whereMonth('orders.created_at', $month)
                ->whereYear('orders.created_at', $currentYear)
                ->distinct()
                ->count('orders.id');

            // Items sold per month
            $items = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('products.produsen_id', $produsenId)
                ->where('orders.status', 'completed')
                ->whereMonth('orders.created_at', $month)
                ->whereYear('orders.created_at', $currentYear)
                ->sum('order_items.quantity') ?? 0;

            // Revenue per month
            $revenue = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('products.produsen_id', $produsenId)
                ->where('orders.status', 'completed')
                ->whereMonth('orders.created_at', $month)
                ->whereYear('orders.created_at', $currentYear)
                ->selectRaw('SUM(order_items.price * order_items.quantity) as total')
                ->value('total') ?? 0;

            $monthlyData[$month] = [
                'month_name' => $monthNames[$month] . ' ' . $currentYear,
                'orders' => $orders,
                'items' => $items,
                'revenue' => $revenue
            ];

            $chartData[$month] = $revenue;
            $totalOrders += $orders;
            $totalItems += $items;
        }

        return view('produsen.reports', compact(
            'totalProducts',
            'ordersThisMonth',
            'revenueThisMonth',
            'totalRevenue',
            'monthlyData',
            'chartData',
            'totalOrders',
            'totalItems'
        ));
    }
}
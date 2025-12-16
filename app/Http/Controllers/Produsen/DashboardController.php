<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $produsen = Auth::user();
        
        // Get produsen's products IDs
        $productIds = Product::where('produsen_id', $produsen->id)->pluck('id');
        
        // Statistics
        $stats = $this->getProdusenStats($productIds);
        
        // Sales Chart Data (12 bulan terakhir)
        $salesChart = $this->getSalesChartData($productIds);
        
        // Recent Orders
        $recentOrders = $this->getRecentOrders($productIds);
        
        // Top Products
        $topProducts = $this->getTopProducts($productIds);

        return view('produsen.dashboard', compact(
            'stats',
            'salesChart',
            'recentOrders',
            'topProducts'
        ));
    }

    private function getProdusenStats($productIds)
    {
        // Total Penjualan (completed orders)
        $totalSales = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'completed');
            })
            ->sum(DB::raw('price * quantity'));

        // Total Penjualan bulan lalu
        $lastMonthSales = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'completed')
                  ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                  ->whereYear('created_at', Carbon::now()->subMonth()->year);
            })
            ->sum(DB::raw('price * quantity'));

        $salesGrowth = $this->calculateGrowth($totalSales, $lastMonthSales);

        // Total Produk
        $totalProducts = Product::where('produsen_id', Auth::id())->count();
        
        $lastMonthProducts = Product::where('produsen_id', Auth::id())
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        
        $productsGrowth = $this->calculateGrowth($totalProducts, $totalProducts - $lastMonthProducts);

        // Promo Aktif (jika ada tabel promo)
        $activePromos = 0;
        $promosGrowth = 0;
        
        try {
            $activePromos = DB::table('promos')
                ->where('produsen_id', Auth::id())
                ->where('is_active', true)
                ->where('end_date', '>=', Carbon::now())
                ->count();
            
            $lastMonthPromos = DB::table('promos')
                ->where('produsen_id', Auth::id())
                ->where('is_active', true)
                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year)
                ->count();
            
            $promosGrowth = $this->calculateGrowth($activePromos, $activePromos - $lastMonthPromos);
        } catch (\Exception $e) {
            // Table promo tidak ada
        }

        // Total Pembeli Unik
        $totalBuyers = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'completed');
            })
            ->distinct('order_id')
            ->count('order_id');

        $lastMonthBuyers = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'completed')
                  ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                  ->whereYear('created_at', Carbon::now()->subMonth()->year);
            })
            ->distinct('order_id')
            ->count('order_id');

        $buyersGrowth = $this->calculateGrowth($totalBuyers, $lastMonthBuyers);

        // Pending Orders
        $pendingOrders = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'pending');
            })
            ->count();

        return [
            'total_sales' => $totalSales,
            'sales_growth' => $salesGrowth,
            'total_products' => $totalProducts,
            'products_growth' => $productsGrowth,
            'active_promos' => $activePromos,
            'promos_growth' => $promosGrowth,
            'total_buyers' => $totalBuyers,
            'buyers_growth' => $buyersGrowth,
            'pending_orders' => $pendingOrders
        ];
    }

    private function getSalesChartData($productIds)
    {
        $months = [];
        $salesData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');

            $monthlySales = OrderItem::whereIn('product_id', $productIds)
                ->whereHas('order', function($q) use ($date) {
                    $q->where('status', 'completed')
                      ->whereMonth('created_at', $date->month)
                      ->whereYear('created_at', $date->year);
                })
                ->sum(DB::raw('price * quantity'));

            $salesData[] = (float) $monthlySales;
        }

        return [
            'months' => $months,
            'data' => $salesData
        ];
    }

    private function getRecentOrders($productIds)
    {
        return OrderItem::with(['order.user', 'product'])
            ->whereIn('product_id', $productIds)
            ->whereHas('order')
            ->latest()
            ->take(10)
            ->get()
            ->map(function($item) {
                return [
                    'product_name' => $item->product->name ?? 'N/A',
                    'quantity' => $item->quantity,
                    'status' => $item->order->status ?? 'unknown',
                    'total' => $item->price * $item->quantity,
                    'customer_name' => $item->order->user->name ?? 'Guest',
                    'order_number' => $item->order->order_number ?? '-',
                    'created_at' => $item->created_at
                ];
            });
    }

    private function getTopProducts($productIds)
    {
        return OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereIn('product_id', $productIds)
            ->whereHas('order', function($q) {
                $q->where('status', 'completed');
            })
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->with('product')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->product->name ?? 'N/A',
                    'total_sold' => $item->total_sold,
                    'image' => $item->product->image ?? null
                ];
            });
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return round((($current - $previous) / $previous) * 100, 1);
    }
}
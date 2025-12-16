<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data penjualan 12 bulan terakhir
        $salesByMonth = $this->getSalesData();
        
        // Weekly Stats
        $weeklyStats = $this->getWeeklyStats();
        
        // Recent Transactions
        $recentTransactions = $this->getRecentTransactions();

        return view('admin.dashboard', compact('salesByMonth', 'weeklyStats', 'recentTransactions'));
    }

    private function getSalesData()
    {
        $months = [];
        $currentMonthData = [];
        $lastMonthData = [];

        // Loop 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');

            // Data bulan ini (tahun ini)
            $currentTotal = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'completed')
                ->sum('total_amount');
            
            $currentMonthData[] = $currentTotal;

            // Data bulan yang sama tahun lalu
            $lastYearDate = $date->copy()->subYear();
            $lastTotal = Order::whereYear('created_at', $lastYearDate->year)
                ->whereMonth('created_at', $lastYearDate->month)
                ->where('status', 'completed')
                ->sum('total_amount');
            
            $lastMonthData[] = $lastTotal;
        }

        return [
            'months' => $months,
            'current' => $currentMonthData,
            'last' => $lastMonthData
        ];
    }

    private function getWeeklyStats()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // Top Sales
        $salesThisWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 'completed')
            ->sum('total_amount');
        
        $salesLastWeek = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->where('status', 'completed')
            ->sum('total_amount');
        
        $salesGrowth = $this->calculateGrowth($salesThisWeek, $salesLastWeek);

        // Best Product (paling banyak terjual minggu ini)
        $bestProduct = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek])
            ->where('orders.status', 'completed')
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->first();

        $bestProductLastWeek = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$startOfLastWeek, $endOfLastWeek])
            ->where('orders.status', 'completed')
            ->where('order_items.product_id', $bestProduct->id ?? 0)
            ->sum('order_items.quantity');

        $productGrowth = $this->calculateGrowth(
            $bestProduct->total_sold ?? 0, 
            $bestProductLastWeek
        );

        // Reviews
        $reviewsThisWeek = DB::table('reviews')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $reviewsLastWeek = DB::table('reviews')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $reviewsGrowth = $this->calculateGrowth($reviewsThisWeek, $reviewsLastWeek);

        // New Users
        $usersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $usersGrowth = $this->calculateGrowth($usersThisWeek, $usersLastWeek);

        return [
            'top_sales' => [
                'amount' => $salesThisWeek,
                'growth' => $salesGrowth
            ],
            'best_product' => [
                'name' => $bestProduct->name ?? 'N/A',
                'growth' => $productGrowth
            ],
            'reviews' => [
                'count' => $reviewsThisWeek,
                'growth' => $reviewsGrowth
            ],
            'new_users' => [
                'count' => $usersThisWeek,
                'growth' => $usersGrowth
            ]
        ];
    }

    private function getRecentTransactions()
    {
        return Order::with(['user', 'orderItems.product'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($order) {
                return [
                    'customer' => [
                        'name' => $order->user->name ?? 'Guest',
                        'email' => $order->user->email ?? 'guest@email.com',
                        'avatar' => $order->user->avatar ?? 'admin/assets/images/profile/user-1.jpg'
                    ],
                    'product' => $order->orderItems->first()->product->name ?? 'N/A',
                    'status' => $order->status,
                    'amount' => $order->total_amount,
                    'created_at' => $order->created_at
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
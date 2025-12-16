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
        try {
            // Ambil data penjualan 12 bulan terakhir
            $salesByMonth = $this->getSalesData();
            
            // Weekly Stats
            $weeklyStats = $this->getWeeklyStats();
            
            // Recent Transactions
            $recentTransactions = $this->getRecentTransactions();

            // Debug: uncomment baris berikut untuk lihat data
            // dd($salesByMonth, $weeklyStats, $recentTransactions);

            return view('admin.dashboard', compact('salesByMonth', 'weeklyStats', 'recentTransactions'));
        } catch (\Exception $e) {
            // Jika error, tampilkan pesan
            return back()->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
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
                ->sum('total_amount') ?? 0;
            
            $currentMonthData[] = (float) $currentTotal;

            // Data bulan yang sama tahun lalu
            $lastYearDate = $date->copy()->subYear();
            $lastTotal = Order::whereYear('created_at', $lastYearDate->year)
                ->whereMonth('created_at', $lastYearDate->month)
                ->where('status', 'completed')
                ->sum('total_amount') ?? 0;
            
            $lastMonthData[] = (float) $lastTotal;
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
            ->sum('total_amount') ?? 0;
        
        $salesLastWeek = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->where('status', 'completed')
            ->sum('total_amount') ?? 0;
        
        $salesGrowth = $this->calculateGrowth($salesThisWeek, $salesLastWeek);

        // Best Product
        $bestProductName = 'N/A';
        $productGrowth = 0;

        try {
            $bestProductQuery = DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
                ->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek])
                ->where('orders.status', 'completed')
                ->groupBy('products.id', 'products.name')
                ->orderBy('total_sold', 'desc')
                ->first();

            if ($bestProductQuery) {
                $bestProductName = $bestProductQuery->name;
                $totalSoldThisWeek = $bestProductQuery->total_sold;

                $bestProductLastWeek = DB::table('order_items')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->whereBetween('orders.created_at', [$startOfLastWeek, $endOfLastWeek])
                    ->where('orders.status', 'completed')
                    ->where('order_items.product_id', $bestProductQuery->id)
                    ->sum('order_items.quantity') ?? 0;

                $productGrowth = $this->calculateGrowth($totalSoldThisWeek, $bestProductLastWeek);
            }
        } catch (\Exception $e) {
            // If order_items or products table doesn't exist
            $bestProductName = 'N/A';
            $productGrowth = 0;
        }

        // Reviews
        $reviewsThisWeek = 0;
        $reviewsGrowth = 0;

        try {
            $reviewsThisWeek = DB::table('reviews')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->count();

            $reviewsLastWeek = DB::table('reviews')
                ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                ->count();

            $reviewsGrowth = $this->calculateGrowth($reviewsThisWeek, $reviewsLastWeek);
        } catch (\Exception $e) {
            $reviewsThisWeek = 0;
            $reviewsGrowth = 0;
        }

        // New Users
        $usersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $usersGrowth = $this->calculateGrowth($usersThisWeek, $usersLastWeek);

        // Return with proper array structure
        return [
            'top_sales' => [
                'amount' => (float) $salesThisWeek,
                'growth' => (float) $salesGrowth
            ],
            'best_product' => [
                'name' => $bestProductName,
                'growth' => (float) $productGrowth
            ],
            'reviews' => [
                'count' => (int) $reviewsThisWeek,
                'growth' => (float) $reviewsGrowth
            ],
            'new_users' => [
                'count' => (int) $usersThisWeek,
                'growth' => (float) $usersGrowth
            ]
        ];
    }

    private function getRecentTransactions()
    {
        try {
            $orders = Order::with(['user', 'orderItems.product'])
                ->latest()
                ->take(5)
                ->get();

            $transactions = [];
            
            foreach ($orders as $order) {
                $productName = 'N/A';
                
                if ($order->orderItems && $order->orderItems->count() > 0) {
                    $firstItem = $order->orderItems->first();
                    if ($firstItem && $firstItem->product) {
                        $productName = $firstItem->product->name;
                    }
                }

                $transactions[] = [
                    'customer' => [
                        'name' => $order->user->name ?? 'Guest',
                        'email' => $order->user->email ?? 'guest@email.com',
                        'avatar' => $order->user->avatar ?? 'admin/assets/images/profile/user-1.jpg'
                    ],
                    'product' => $productName,
                    'status' => $order->status ?? 'pending',
                    'amount' => (float) ($order->total_amount ?? 0),
                    'created_at' => $order->created_at
                ];
            }

            return $transactions;
        } catch (\Exception $e) {
            return [];
        }
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return round((($current - $previous) / $previous) * 100, 1);
    }
}
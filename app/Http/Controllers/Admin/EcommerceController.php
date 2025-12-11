<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('ecommerce.index', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalRevenue',
            'recentProducts'
        ));
    }
}
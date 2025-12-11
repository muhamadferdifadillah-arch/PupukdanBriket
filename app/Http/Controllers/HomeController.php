<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua kategori dari tabel categories
        $categories = Category::all();

        // Ambil 8 produk terbaru dari tabel products
        $bestProducts = Product::latest()->take(8)->get();

        // Kirim ke view
        return view('user.home', compact('categories', 'bestProducts'));
    }

    public function shop()
    {
        // Ambil semua produk untuk halaman shop
        $products = Product::latest()->paginate(12);

        // Kirim ke view shop
        return view('user.shop', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PortalController extends Controller
{
    /**
     * Tampilkan halaman portal/landing page
     */
    public function index()
    {
        // Ambil 6 produk featured/populer dari database
        $products = Product::with('category')
                          ->active()
                          ->popular()
                          ->take(6)
                          ->get();

        return view('portal', compact('products'));
    }
}
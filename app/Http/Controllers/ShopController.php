<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->paginate(12);
        return view('pages.shop', compact('products'));
    }
}
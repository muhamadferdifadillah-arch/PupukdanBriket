<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12);

        return view('user.shop', compact('products'));
    }
}

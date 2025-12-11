<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('products.index', compact('products'));
    }
    
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $id)
                                  ->limit(4)
                                  ->get();
        return view('products.show', compact('product', 'relatedProducts'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->paginate(12);
        return view('products.index', compact('products', 'query'));
    }
}
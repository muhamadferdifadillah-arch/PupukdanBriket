<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;

        $products = Product::where('name', 'LIKE', "%$query%")->get();

        return view('user.search', compact('query', 'products'));
    }
}

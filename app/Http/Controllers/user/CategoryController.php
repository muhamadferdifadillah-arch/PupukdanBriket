<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->paginate(12);


        return view('user.category.show', compact('category', 'products'));
    }

    public function index()
{
    $categories = \App\Models\Category::all();

    return view('user.category.index', compact('categories'));

}

}

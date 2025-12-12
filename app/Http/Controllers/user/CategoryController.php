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
    $categories = Category::all();

    // Tambahkan icon sesuai slug kategori
    foreach ($categories as $cat) {
        if ($cat->slug == 'organic-fertilizer') {
            $cat->icon_image = 'user/images/logoD.png';
        } elseif ($cat->slug == 'charcoal') {
            $cat->icon_image = 'user/images/logoA.png';
        } elseif ($cat->slug == 'charcoal-briquettes') {
            $cat->icon_image = 'user/images/logos.png';
        } else {
            $cat->icon_image = 'user/images/default-category.png';
        }
    }

    return view('user.category.index', compact('categories'));
}

}

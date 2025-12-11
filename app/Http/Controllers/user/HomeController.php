<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data kategori
        $categories = [
            [
                'id' => 1,
                'name' => 'Vegetables',
                'icon' => '🥬',
                'product_count' => 165,
                'image' => 'https://via.placeholder.com/200/4CAF50/FFFFFF?text=Vegetables'
            ],
            [
                'id' => 2,
                'name' => 'Fresh Fruit',
                'icon' => '🍎',
                'product_count' => 137,
                'image' => 'https://via.placeholder.com/200/FF9800/FFFFFF?text=Fruits'
            ],
            [
                'id' => 3,
                'name' => 'Fish',
                'icon' => '🐟',
                'product_count' => 34,
                'image' => 'https://via.placeholder.com/200/2196F3/FFFFFF?text=Fish'
            ],
            [
                'id' => 4,
                'name' => 'Meat',
                'icon' => '🥩',
                'product_count' => 86,
                'image' => 'https://via.placeholder.com/200/F44336/FFFFFF?text=Meat'
            ],
            [
                'id' => 5,
                'name' => 'Snacks',
                'icon' => '🍿',
                'product_count' => 56,
                'image' => 'https://via.placeholder.com/200/FFC107/FFFFFF?text=Snacks'
            ],
            [
                'id' => 6,
                'name' => 'Beverages',
                'icon' => '🥤',
                'product_count' => 43,
                'image' => 'https://via.placeholder.com/200/9C27B0/FFFFFF?text=Beverages'
            ]
        ];

        // Data produk featured
        $featuredProducts = [
            [
                'id' => 1,
                'name' => 'Fresh Organic Tomatoes',
                'category' => 'Vegetables',
                'price' => 45000,
                'original_price' => 60000,
                'discount' => 25,
                'rating' => 4.5,
                'reviews' => 128,
                'stock' => 50,
                'image' => 'https://via.placeholder.com/300/FF6347/FFFFFF?text=Tomatoes'
            ],
            [
                'id' => 2,
                'name' => 'Premium Apples',
                'category' => 'Fresh Fruit',
                'price' => 85000,
                'original_price' => 100000,
                'discount' => 15,
                'rating' => 4.8,
                'reviews' => 256,
                'stock' => 30,
                'image' => 'https://via.placeholder.com/300/DC143C/FFFFFF?text=Apples'
            ],
            [
                'id' => 3,
                'name' => 'Fresh Salmon',
                'category' => 'Fish',
                'price' => 150000,
                'original_price' => 180000,
                'discount' => 17,
                'rating' => 4.9,
                'reviews' => 89,
                'stock' => 15,
                'image' => 'https://via.placeholder.com/300/FFA07A/FFFFFF?text=Salmon'
            ],
            [
                'id' => 4,
                'name' => 'Organic Carrots',
                'category' => 'Vegetables',
                'price' => 35000,
                'original_price' => 45000,
                'discount' => 22,
                'rating' => 4.6,
                'reviews' => 178,
                'stock' => 80,
                'image' => 'https://via.placeholder.com/300/FF8C00/FFFFFF?text=Carrots'
            ]
        ];

        // Data best deals
        $bestDeals = [
            [
                'id' => 1,
                'name' => 'Organic Broccoli',
                'price' => 38000,
                'original_price' => 50000,
                'discount' => 24,
                'image' => 'https://via.placeholder.com/250/228B22/FFFFFF?text=Broccoli'
            ],
            [
                'id' => 2,
                'name' => 'Fresh Strawberries',
                'price' => 65000,
                'original_price' => 80000,
                'discount' => 19,
                'image' => 'https://via.placeholder.com/250/DC143C/FFFFFF?text=Strawberry'
            ],
            [
                'id' => 3,
                'name' => 'Chicken Breast',
                'price' => 95000,
                'original_price' => 120000,
                'discount' => 21,
                'image' => 'https://via.placeholder.com/250/FFE4B5/FFFFFF?text=Chicken'
            ]
        ];

        return view('user.home', compact('categories', 'featuredProducts', 'bestDeals'));
    }
}
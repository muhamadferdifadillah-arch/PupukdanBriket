<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        // Data produk contoh (nanti bisa dari database)
        $products = [
            [
                'id' => 1,
                'name' => 'Premium Package',
                'category' => 'Digital Service',
                'price' => 3900000,
                'stock' => 50,
                'status' => 'active',
                'image' => 'https://via.placeholder.com/150/0D6EFD/FFFFFF?text=Premium'
            ],
            [
                'id' => 2,
                'name' => 'Basic Package',
                'category' => 'Digital Service',
                'price' => 1500000,
                'stock' => 100,
                'status' => 'active',
                'image' => 'https://via.placeholder.com/150/198754/FFFFFF?text=Basic'
            ],
            [
                'id' => 3,
                'name' => 'Enterprise Package',
                'category' => 'Digital Service',
                'price' => 12800000,
                'stock' => 20,
                'status' => 'active',
                'image' => 'https://via.placeholder.com/150/DC3545/FFFFFF?text=Enterprise'
            ],
            [
                'id' => 4,
                'name' => 'Starter Package',
                'category' => 'Digital Service',
                'price' => 750000,
                'stock' => 0,
                'status' => 'out_of_stock',
                'image' => 'https://via.placeholder.com/150/FFC107/FFFFFF?text=Starter'
            ]
        ];

        return view('admin.ecommerce', compact('products'));
    }
}
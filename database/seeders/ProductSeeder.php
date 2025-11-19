<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Organic Fertilizer Premium',
                'description' => 'High quality organic fertilizer for your plants',
                'price' => 50000,
                'category' => 'fertilizer',
                'image' => 'user/images/product-thumb-1.png',
                'stock' => 100,
                'is_featured' => true,
            ],
            [
                'name' => 'Charcoal Briquettes',
                'description' => 'Premium charcoal briquettes for BBQ',
                'price' => 75000,
                'category' => 'charcoal',
                'image' => 'user/images/product-thumb-2.png',
                'stock' => 50,
                'is_featured' => true,
            ],
            [
                'name' => 'Liquid Compost Fertilizer',
                'description' => 'Natural liquid compost for organic farming',
                'price' => 35000,
                'category' => 'compost',
                'image' => 'user/images/product-thumb-3.png',
                'stock' => 80,
                'is_featured' => false,
            ],
            [
                'name' => 'Coconut Shell Charcoal',
                'description' => 'Premium coconut shell charcoal',
                'price' => 60000,
                'category' => 'charcoal',
                'image' => 'user/images/product-thumb-1.png',
                'stock' => 120,
                'is_featured' => true,
            ],
            [
                'name' => 'NPK Organic Fertilizer',
                'description' => 'Complete NPK organic fertilizer',
                'price' => 45000,
                'category' => 'fertilizer',
                'image' => 'user/images/product-thumb-2.png',
                'stock' => 90,
                'is_featured' => false,
            ],
            [
                'name' => 'Solid Compost',
                'description' => 'Solid compost from organic waste',
                'price' => 25000,
                'category' => 'compost',
                'image' => 'user/images/product-thumb-3.png',
                'stock' => 150,
                'is_featured' => true,
            ],
            [
                'name' => 'Hexagonal Briquettes',
                'description' => 'Hexagonal shape charcoal briquettes',
                'price' => 80000,
                'category' => 'briquettes',
                'image' => 'user/images/product-thumb-1.png',
                'stock' => 60,
                'is_featured' => false,
            ],
            [
                'name' => 'Bio Organic Fertilizer',
                'description' => 'Bio organic fertilizer with microorganisms',
                'price' => 55000,
                'category' => 'fertilizer',
                'image' => 'user/images/product-thumb-2.png',
                'stock' => 70,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
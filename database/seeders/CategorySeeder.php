<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pupuk Organik',
                'slug' => 'pupuk-organik',
                'description' => 'Pupuk dari bahan organik alami',
                'status' => 'active',
                'order' => 1
            ],
            [
                'name' => 'Pupuk Anorganik',
                'slug' => 'pupuk-anorganik',
                'description' => 'Pupuk kimia untuk pertanian',
                'status' => 'active',
                'order' => 2
            ],
            [
                'name' => 'Briket',
                'slug' => 'briket',
                'description' => 'Briket untuk bahan bakar',
                'status' => 'active',
                'order' => 3
            ],
            [
                'name' => 'Peralatan Tani',
                'slug' => 'peralatan-tani',
                'description' => 'Alat-alat pertanian',
                'status' => 'active',
                'order' => 4
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
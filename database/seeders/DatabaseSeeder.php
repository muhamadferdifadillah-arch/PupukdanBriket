<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin Manfaatin',
            'email' => 'admin@manfaatin.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat User Biasa
        User::create([
            'name' => 'User Test',
            'email' => 'user@manfaatin.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Buat beberapa user dummy
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
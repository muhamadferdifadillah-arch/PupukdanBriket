<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        
        if ($products->count() == 0) {
            echo "Tidak ada produk. Silakan buat produk terlebih dahulu.\n";
            return;
        }

        // Buat 10 order dummy
        for ($i = 1; $i <= 10; $i++) {
            $order = Order::create([
                'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'customer_name' => 'Customer ' . $i,
                'customer_email' => 'customer' . $i . '@example.com',
                'customer_phone' => '08123456789' . $i,
                'total_amount' => 0,
                'status' => ['pending', 'processing', 'completed', 'cancelled'][rand(0, 3)],
                'payment_method' => ['cash', 'transfer', 'credit_card', 'e-wallet'][rand(0, 3)],
                'payment_status' => ['unpaid', 'paid'][rand(0, 1)],
                'shipping_address' => 'Jl. Contoh No. ' . $i . ', Jakarta',
                'notes' => 'Catatan pesanan ' . $i,
            ]);

            // Tambahkan 1-3 produk per order
            $totalAmount = 0;
            $itemCount = rand(1, 3);
            
            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $quantity = rand(1, 5);
                $subtotal = $product->price * $quantity;
                $totalAmount += $subtotal;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
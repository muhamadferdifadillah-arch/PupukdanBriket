<?php

/**
 * SECURE DATABASE QUERY EXAMPLES
 * 
 * File ini menunjukkan contoh-contoh query yang aman terhadap SQL Injection
 * dan best practices untuk database operations di Laravel
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class SecureDatabaseRepository
{
    /**
     * ✅ SECURE: Menggunakan Eloquent ORM (parameterized queries)
     * 
     * Eloquent secara otomatis melindungi dari SQL Injection karena menggunakan
     * parameterized queries di bawah hood
     */
    public function getUserByEmailSecure($email)
    {
        // Cara 1: Menggunakan Eloquent
        return User::where('email', $email)->first();
        
        // Cara 2: Menggunakan Query Builder
        return DB::table('users')->where('email', $email)->first();
    }

    /**
     * ✅ SECURE: Menggunakan named bindings dalam raw queries
     */
    public function searchUsersSecure($searchTerm)
    {
        return DB::select(
            "SELECT * FROM users WHERE name LIKE :search OR email LIKE :search",
            ['search' => '%' . $searchTerm . '%']
        );
    }

    /**
     * ✅ SECURE: Menggunakan positional bindings (?) dalam raw queries
     */
    public function getOrdersSecure($userId, $status)
    {
        return DB::select(
            "SELECT * FROM orders WHERE user_id = ? AND status = ?",
            [$userId, $status]
        );
    }

    /**
     * ❌ TIDAK AMAN: String concatenation (JANGAN DIGUNAKAN!!!)
     * 
     * Query ini RENTAN terhadap SQL Injection karena menggunakan
     * string concatenation secara langsung
     * 
     * Contoh attack:
     * $email = "admin' OR '1'='1"
     * Result query: SELECT * FROM users WHERE email = 'admin' OR '1'='1'
     * Ini akan return semua users!
     */
    public function getUserByEmailInsecure($email)
    {
        // ❌ JANGAN GUNAKAN INI:
        // return DB::select("SELECT * FROM users WHERE email = '$email'");
        
        // ❌ JANGAN GUNAKAN INI JUGA:
        // return DB::select("SELECT * FROM users WHERE email = " . $email);
    }

    /**
     * ✅ SECURE: UPDATE query dengan prepared statements
     */
    public function updateUserSecure($userId, $name, $email)
    {
        return DB::update(
            'UPDATE users SET name = ?, email = ? WHERE id = ?',
            [$name, $email, $userId]
        );
    }

    /**
     * ✅ SECURE: DELETE query dengan prepared statements
     */
    public function deleteOrderSecure($orderId, $userId)
    {
        // Pastikan user ownership sebelum delete (authorization check)
        return DB::delete(
            'DELETE FROM orders WHERE id = ? AND user_id = ?',
            [$orderId, $userId]
        );
    }

    /**
     * ✅ SECURE: INSERT query menggunakan Eloquent
     */
    public function createUserSecure($userData)
    {
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => \Hash::make($userData['password']),
        ]);
    }

    /**
     * ✅ SECURE: Complex query dengan multiple joins
     */
    public function getOrderDetailsSecure($orderId, $userId)
    {
        return DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.id', $orderId)
            ->where('orders.user_id', $userId)
            ->select('orders.*', 'order_details.*', 'products.name', 'products.price')
            ->get();
    }

    /**
     * ✅ SECURE: Search dengan proper escaping dan validation
     */
    public function searchProductsSecure($searchTerm, $categoryId = null)
    {
        $query = Product::query();

        // Validasi input terlebih dahulu
        $searchTerm = preg_replace('/[^a-zA-Z0-9\s\-\_]/i', '', $searchTerm);
        
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
        });

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->paginate(20);
    }

    /**
     * ✅ SECURE: Bulk operations dengan proper error handling
     */
    public function bulkUpdateOrdersSecure($orderIds, $status)
    {
        // Validasi input
        $orderIds = array_filter(array_map('intval', $orderIds));
        $validStatuses = ['pending', 'processing', 'completed', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        return DB::table('orders')
            ->whereIn('id', $orderIds)
            ->update(['status' => $status]);
    }

    /**
     * ✅ SECURE: Transaction untuk maintain data integrity
     */
    public function createOrderWithDetailsSecure($userId, $items)
    {
        return DB::transaction(function () use ($userId, $items) {
            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'total' => 0,
            ]);

            $total = 0;
            
            // Create order details
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                
                if (!$product) {
                    throw new \Exception('Product not found');
                }

                $orderDetail = $order->details()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $total += $orderDetail->quantity * $product->price;
            }

            // Update total
            $order->update(['total' => $total]);

            return $order;
        });
    }

    /**
     * 📋 BEST PRACTICES SUMMARY:
     * 
     * 1. SELALU gunakan parameterized queries (prepared statements)
     * 2. JANGAN pernah gunakan string concatenation dengan user input
     * 3. VALIDASI semua user input sebelum digunakan di query
     * 4. GUNAKAN Eloquent ORM atau Query Builder (bukan raw queries jika bisa)
     * 5. IMPLEMENT proper authorization checks (siapa yang boleh akses data)
     * 6. GUNAKAN transactions untuk operations yang kompleks
     * 7. ERROR HANDLING: jangan expose error details ke user di production
     * 8. LOGGING: log semua query untuk audit trail & debugging
     * 9. MONITORING: monitor untuk unusual query patterns
     * 10. REGULAR UPDATES: keep Laravel & dependencies selalu up-to-date
     */
}

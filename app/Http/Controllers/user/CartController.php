<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    // ============================
    // TAMPILKAN HALAMAN KERANJANG
    // ============================
    public function index()
    {
        $userId = Auth::id();
        
        $cartItems = DB::table('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $userId)
            ->select('c.*', 'p.name', 'p.image', 'p.price')
            ->get();
        
        $total = $cartItems->sum('subtotal');
        
        return view('user.cart', compact('cartItems', 'total'));
    }
    
    // ============================
    // TAMBAH KE KERANJANG (AJAX)
    // ============================
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }
        
        $userId    = Auth::id();
        $productId = $request->product_id;
        $quantity  = $request->quantity ?? 1;
        
        // Ambil data produk
        $product = DB::table('products')->where('id', $productId)->first();
        
        if (!$product) {
            return response()->json([
                'success' => false, 
                'message' => 'Produk tidak ditemukan'
            ]);
        }
        
        // Cek apakah sudah ada di cart
        $existing = DB::table('cart')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        
        if ($existing) {
            // Update quantity
            $newQuantity = $existing->quantity + $quantity;
            $newSubtotal = $newQuantity * $product->price;
            
            DB::table('cart')
                ->where('id', $existing->id)
                ->update([
                    'quantity' => $newQuantity,
                    'subtotal' => $newSubtotal
                ]);
        } else {
            // Insert baru
            DB::table('cart')->insert([
                'user_id'    => $userId,
                'product_id' => $productId,
                'price'      => $product->price,
                'quantity'   => $quantity,
                'subtotal'   => $quantity * $product->price,
                'created_at' => now()
            ]);
        }
        
        // Hitung total item
        $totalItems = DB::table('cart')
            ->where('user_id', $userId)
            ->sum('quantity');
        
        return response()->json([
            'success'    => true,
            'message'    => 'Produk berhasil ditambahkan',
            'cart_count' => $totalItems
        ]);
    }
    
    // =======================================
    // UPDATE QUANTITY (DIPANGGIL DARI JS-MU)
    // route: PATCH /cart/update/{id}
    // body:  { quantity: X }
    // =======================================
    public function update(Request $request, $id)
    {
        $userId   = Auth::id();
        $quantity = (int) $request->quantity;

        $cart = DB::table('cart')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ]);
        }

        if ($quantity < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity minimal 1'
            ]);
        }
        
        // Update item
        $itemSubtotal = $quantity * $cart->price;

        DB::table('cart')
            ->where('id', $id)
            ->update([
                'quantity' => $quantity,
                'subtotal' => $itemSubtotal
            ]);

        // Hitung ulang summary
        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->get();

        $subtotal  = $cartItems->sum('subtotal');
        $shipping  = 0;
        $tax       = $subtotal * 0.10;
        $total     = $subtotal + $shipping + $tax;
        $cartCount = $cartItems->sum('quantity');

        return response()->json([
            'success'   => true,
            'message'   => 'Keranjang berhasil diupdate',
            'subtotal'  => number_format($subtotal, 0, ',', '.'),
            'tax'       => number_format($tax, 0, ',', '.'),
            'total'     => number_format($total, 0, ',', '.'),
            'cartCount' => $cartCount
        ]);
    }
    
    // ========================================
    // HAPUS ITEM (DIPANGGIL DARI JS-MU)
    // route: DELETE /cart/remove/{id}
    // ========================================
    public function remove(Request $request, $id)
    {
        $userId = Auth::id();

        DB::table('cart')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        // Hitung ulang cart
        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->get();

        $isEmpty = $cartItems->count() === 0;

        if ($isEmpty) {
            return response()->json([
                'success'   => true,
                'message'   => 'Item berhasil dihapus',
                'isEmpty'   => true,
                'subtotal'  => 0,
                'shipping'  => 0,
                'tax'       => 0,
                'total'     => 0,
                'cartCount' => 0,
            ]);
        }

        $subtotal  = $cartItems->sum('subtotal');
        $shipping  = 0;
        $tax       = $subtotal * 0.10;
        $total     = $subtotal + $shipping + $tax;
        $cartCount = $cartItems->sum('quantity');

        return response()->json([
            'success'   => true,
            'message'   => 'Item berhasil dihapus',
            'isEmpty'   => false,
            'subtotal'  => number_format($subtotal, 0, ',', '.'),
            'shipping'  => number_format($shipping, 0, ',', '.'),
            'tax'       => number_format($tax, 0, ',', '.'),
            'total'     => number_format($total, 0, ',', '.'),
            'cartCount' => $cartCount,
        ]);
    }
}

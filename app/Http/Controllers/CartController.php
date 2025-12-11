<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('layouts.user.dashboard', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity']
                ];
                $subtotal += $product->price * $item['quantity'];
            }
        }

        $shipping = $subtotal > 0 ? 5 : 0;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        return view('user.cart', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        
        Session::put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'cartCount' => count($cart)
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            
            $product = Product::find($id);
            $subtotal = 0;
            foreach ($cart as $cartId => $item) {
                $prod = Product::find($cartId);
                $subtotal += $prod->price * $item['quantity'];
            }
            
            $shipping = 5;
            $tax = $subtotal * 0.1;
            $total = $subtotal + $shipping + $tax;
            
            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2),
                'cartCount' => array_sum(array_column($cart, 'quantity'))
            ]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            
            $subtotal = 0;
            foreach ($cart as $cartId => $item) {
                $product = Product::find($cartId);
                $subtotal += $product->price * $item['quantity'];
            }
            
            $shipping = $subtotal > 0 ? 5 : 0;
            $tax = $subtotal * 0.1;
            $total = $subtotal + $shipping + $tax;
            
            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 2),
                'shipping' => number_format($shipping, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2),
                'cartCount' => array_sum(array_column($cart, 'quantity')),
                'isEmpty' => empty($cart)
            ]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function clear()
    {
        Session::forget('cart');
        return response()->json(['success' => true]);
    }
}
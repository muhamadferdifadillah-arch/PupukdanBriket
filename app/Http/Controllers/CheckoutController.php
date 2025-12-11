<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('checkout.index', compact('cart', 'total'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        
        // Proses checkout
        // Simpan order ke database
        
        session()->forget('cart');
        
        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}
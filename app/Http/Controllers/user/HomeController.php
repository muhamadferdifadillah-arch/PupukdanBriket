<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => [], // Ambil dari database
            'productCount' => 100,
            'customerCount' => 5000,
            'cartCount' => 0,
            'wishlistCount' => 0,
        ];
        
        return view('user.pages.home', $data);
    }
    
    public function about()
    {
        return view('user.pages.about');
    }
    
    public function contact()
    {
        return view('user.pages.contact');
    }
    
    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        // Logic untuk save newsletter
        
        return back()->with('success', 'Thank you for subscribing!');
    }
}
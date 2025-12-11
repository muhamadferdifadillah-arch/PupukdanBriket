<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }
    
    public function add($id)
    {
        $wishlist = session()->get('wishlist', []);
        
        if(!in_array($id, $wishlist)) {
            $wishlist[] = $id;
            session()->put('wishlist', $wishlist);
        }
        
        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist!');
    }
    
    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);
        
        if(($key = array_search($id, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }
        
        return redirect()->back()->with('success', 'Produk dihapus dari wishlist!');
    }
}
<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Produk;

class ProdukProdusenController extends Controller
{
    public function index(): View
    {
        $produk = Produk::where('produsen_id', Auth::id())
            ->latest()
            ->get();

        return view('produsen.products.index', compact('produk'));
    }
}

<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic untuk menampilkan daftar promo
        return view('produsen.promo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produsen.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic untuk menyimpan promo baru
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic untuk menampilkan detail promo
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('produsen.promo.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic untuk update promo
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic untuk delete promo
    }
}
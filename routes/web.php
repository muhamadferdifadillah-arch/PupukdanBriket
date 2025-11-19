<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EcommerceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ShopController;

Route::resource('pengguna', PenggunaController::class);

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('pengguna', PenggunaController::class);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ecommerce', [EcommerceController::class, 'index'])->name('ecommerce');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
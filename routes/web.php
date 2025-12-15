<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Models
use App\Models\User;

// Controllers
use App\Http\Controllers\Admin\PurchaseHistoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\CategoryController as UserCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\OrderController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Produsen\ProdukProdusenController;

// ============================================
// FRONTEND / USER ROUTES
// ============================================

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/search', [PageController::class, 'search'])->name('search.products');
Route::get('/products/charcoal', [ProductController::class, 'charcoal'])->name('products.charcoal');

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user', [HomeController::class, 'index'])->name('user.home');
Route::get('/user/shop', [HomeController::class, 'shop'])->name('user.shop');

// Category (User)
Route::get('/category/{slug}', [UserCategoryController::class, 'show'])->name('category.show');
Route::get('/categories', [UserCategoryController::class, 'index'])->name('categories.index');

// About & Register
Route::get('/about', function () {
    return view('user.pages.about');
});

Route::get('/register', function () {
    return redirect()->route('user.register');
});

// ============================================
// USER PROFILE (LOGIN REQUIRED)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// ============================================
// CART SYSTEM (USER)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{id}', [CartController::class, 'addGet'])->name('cart.add.get');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('user.cart.count');
});

Route::get('/cart/add/{id}', function () {
    return redirect()->back()->with('error', 'Gunakan tombol untuk menambah ke keranjang.');
});

// ============================================
// CHECKOUT SYSTEM (USER)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('user.checkout.process');
});

// ============================================
// USER ORDER ROUTES - DENGAN DAN TANPA PREFIX
// ============================================

// Route dengan prefix /user (user.orders.index)
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Route tanpa prefix untuk akses langsung /orders
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.direct');
});

// ============================================
// DEFAULT LOGIN ROUTE (IMPORTANT!)
// ============================================

Route::get('/login', function () {
    return redirect()->route('user.login');
})->name('login');

// ============================================
// ADMIN AUTH
// ============================================

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ============================================
// USER AUTH
// ============================================

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [LoginController::class, 'showUserLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showUserRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'userRegister'])->name('register.post');
    Route::post('/logout', [LoginController::class, 'userLogout'])->name('logout');
});

// ============================================
// PRODUSEN AUTH
// ============================================

Route::prefix('produsen')->name('produsen.')->group(function () {
    Route::get('/login', [LoginController::class, 'showProdusenLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'produsenLogin'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'produsenLogout'])->name('logout');
});

// ============================================
// ADMIN PANEL (LOGIN + ROLE ADMIN)
// ============================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Admin Profile
    Route::get('/profile', function () {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    })->name('profile');

    Route::put('/profile/update', function (Request $request) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6'
        ]);

        $admin = User::findOrFail(Auth::id());
        $admin->name  = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();
        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    })->name('profile.update');

    // Dashboard
    Route::get('/dashboard', function () {
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total_amount');
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders'
        ));
    })->name('dashboard');

    // Ecommerce page
    Route::get('/ecommerce', function () {
        $products = \App\Models\Product::with('category')->latest()->get();
        $categories = \App\Models\Category::all();
        return view('admin.ecommerce', compact('products', 'categories'));
    })->name('ecommerce');

    // Product CRUD
    Route::resource('products', AdminProductController::class);

    // Purchase History
    Route::get('/purchase-history', [PurchaseHistoryController::class, 'index'])->name('purchase-history.index');
    Route::get('/purchase-history/{id}', [PurchaseHistoryController::class, 'show'])->name('purchase-history.show');
    Route::post('/purchase-history/{id}/update-status', [PurchaseHistoryController::class, 'updateStatus'])->name('purchase-history.update-status');

    // Ecommerce Categories
    Route::prefix('ecommerce')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Reports
    Route::get('/reports/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('reports.sales');
});

// ============================================
// PRODUSEN DASHBOARD (LOGIN + ROLE PRODUSEN)
// ============================================

Route::prefix('produsen')->name('produsen.')->middleware(['auth', 'role:produsen'])->group(function () {
    Route::get('/dashboard', function () {
        return view('produsen.dashboard');
    })->name('dashboard');

    Route::get('/produk', [ProdukProdusenController::class, 'index'])->name('produk');
    
    Route::get('/reports', [App\Http\Controllers\Produsen\ReportController::class, 'index'])->name('reports');
    
    Route::resource('promo', App\Http\Controllers\Produsen\PromoController::class);
});

// ============================================
// LOGOUT FALLBACK
// ============================================

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/user/login');
})->name('logout');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/user/login');
});

// ============================================
// TEST ROUTE
// ============================================

Route::get('/zz-test-produsen', function () {
    return 'ROUTE PRODUSEN OK';
});

// Force logout untuk testing
Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login')->with('message', 'Logout berhasil!');
});

// ============================================
// FILE HANDLER ROUTE (HARUS DI PALING ATAS!)
// ============================================

Route::get('/file/{path}', function ($path) {
    $path = urldecode($path);
 
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    
    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('file.serve');

// Tambahkan route ini untuk backward compatibility
Route::get('/file/uploads/{path}', function ($path) {
    // Redirect ke path yang benar
    $correctPath = str_replace('uploads/products/', 'products/', $path);
    $path = urldecode($correctPath);
 
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    
    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*');
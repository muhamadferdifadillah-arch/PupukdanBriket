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
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\CategoryController as userCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\DB;
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
// USER ORDER ROUTES
// ============================================

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.orders');
    Route::get('/orders/pay/{id}', [App\Http\Controllers\User\OrderController::class, 'pay'])->name('user.orders.pay');
    Route::patch('/orders/complete/{id}', [App\Http\Controllers\User\OrderController::class, 'complete'])->name('user.orders.complete');
    Route::patch('/orders/cancel/{id}', [App\Http\Controllers\User\OrderController::class, 'cancel'])->name('user.orders.cancel');
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

Route::middleware(['auth'])->prefix('produsen')->group(function () {
    Route::get('/reports', [App\Http\Controllers\Produsen\ReportController::class, 'index'])
        ->name('produsen.reports');
    
    Route::resource('promo', App\Http\Controllers\Produsen\PromoController::class)
        ->names([
            'index' => 'produsen.promo.index',
            'create' => 'produsen.promo.create',
            'store' => 'produsen.promo.store',
            'show' => 'produsen.promo.show',
            'edit' => 'produsen.promo.edit',
            'update' => 'produsen.promo.update',
            'destroy' => 'produsen.promo.destroy',
        ]);
});

Route::get('/about', function () {
    return view('user.pages.about');
});

Route::get('/checkout', function () {
    return view('user.checkout');
})->name('checkout');

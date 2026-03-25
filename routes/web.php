<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// --- 1. الصفحات العامة (للزبائن) ---
Route::get('/', [ProductController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// --- 2. صفحات الضيوف (Guest) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- 3. صفحات الأعضاء (Auth) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'store'])->name('order.store');
});

// --- 4. لوحة تحكم الأدمن (ELITE Admin Panel) ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // الرئيسية (الإحصائيات)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // إدارة المنتجات (Resource شامل لجميع العمليات)
    Route::resource('products', ProductController::class);

    // إدارة الطلبات
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
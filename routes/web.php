<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController; // İki tane OrderController olduğu için admin olanına takma ad veriyoruz.

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. BİZİM E-TİCARET VİTRİN ROTALARIMIZ ---
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');

// --- 2. BİZİM ADMİN PANELİ ROTALARIMIZ ---
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('product', \App\Http\Controllers\Admin\AdminProductController::class);
    // Admin Sipariş Yönetimi Rotaları
    Route::prefix('orders')->name('orders.')->controller(AdminOrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{order}', 'show')->name('show');
        Route::post('/status/{order}', 'updateStatus')->name('updateStatus');
    });
});

// --- 3. BREEZE GÜVENLİK VE PROFİL ROTALARI (Yeni Eklenenler) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 4.SEPET VE SİPARİŞ ROTALARI (Sadece Giriş Yapanlar) ---
Route::middleware(['auth'])->group(function () {
    // Sepet İşlemleri
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Sipariş Verme İşlemleri
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
});

require __DIR__.'/auth.php';
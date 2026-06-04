<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. BİZİM E-TİCARET VİTRİN ROTALARIMIZ ---
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class, 'detail'])->name('product.detail');

// --- 2. BİZİM ADMİN PANELİ ROTALARIMIZ ---
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('product', \App\Http\Controllers\Admin\AdminProductController::class);
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

require __DIR__.'/auth.php';
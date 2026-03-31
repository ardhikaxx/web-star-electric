<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [LandingController::class, 'sitemap']);
Route::get('/produk/{product}', [LandingController::class, 'showProduct'])->name('products.show');
Route::get('/produk/{product}/klik', [LandingController::class, 'clickProduct'])->name('products.click');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Forgot PIN
    Route::get('/forgot-pin', [AuthController::class, 'showForgotPin'])->name('forgot-pin');
    Route::post('/forgot-pin', [AuthController::class, 'verifyRecoveryKey'])->name('forgot-pin.post');
    Route::get('/reset-pin', [AuthController::class, 'showResetPinForm'])->name('reset-pin-form');
    Route::post('/reset-pin', [AuthController::class, 'resetPin'])->name('reset-pin.post');

    Route::get('/change-pin', [AuthController::class, 'showChangePin'])->name('change-pin');
    Route::post('/change-pin', [AuthController::class, 'changePin']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
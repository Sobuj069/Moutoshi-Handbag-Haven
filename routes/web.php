<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public product page
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Authenticated profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
});

require __DIR__.'/auth.php';
//admin log in
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login']);
use App\Http\Controllers\AdminAuthController;

// Admin logout route
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

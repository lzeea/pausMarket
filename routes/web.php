<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Default dashboard menampilkan customers (contoh)
Route::get('/', function () {
    return redirect('/login');
});

// Routes untuk Customer
Route::resource('customers', CustomerController::class);

// Routes untuk Product
Route::resource('products', ProductController::class);

// Routes untuk Order
Route::resource('orders', OrderController::class);

// Routes untuk OrderDetail
// Route::resource('order-details', OrderDetailController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

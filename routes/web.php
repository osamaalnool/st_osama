<?php

use App\Http\Controllers\adminMainController;
use App\Http\Controllers\CategoryController;
 use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function()
{   
    view('auth.login');
});

// admin route
Route::prefix('admin')->group(function () {
    Route::resource('/', adminMainController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
       Route::get('/products_sail', [ProductController::class, 'product_sail'])->name('product_sail');
      Route::get('/orders/orderDone', [OrderController::class, 'orderDone'])->name('orders.orderDone');
    Route::resource('/orders', OrderController::class);
      Route::resource('/users', UserController::class);
});

// login route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


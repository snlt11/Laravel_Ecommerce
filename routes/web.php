<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');

Route::post('/', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', fn () => view('admin.home'))->name('admin.home');
    Route::resource('category', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('category.subcategory', SubCategoryController::class)->shallow();
    Route::get('/orders', [OrderController::class, 'allOrder'])->name('all.orders');
    Route::get('/orderItem/{id}', [OrderItemController::class, 'orderItemById'])->name('orderItemById');
});

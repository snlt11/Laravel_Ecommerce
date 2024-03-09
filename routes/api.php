<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);
Route::get('/categories', [ApiController::class, 'categories']);
Route::get('/subcategories/{id}', [ApiController::class, 'subcategories']);
Route::get('/tags', [ApiController::class, 'tags']);
Route::get('/products', [ApiController::class, 'products']);
Route::get('/productByCategoryId/{id}', [ApiController::class,'getProductByCategoryId']);
Route::get('/productBySubCategoryId/{id}', [ApiController::class,'getProductBySubCategoryId']);
Route::get('/productByTagId/{id}', [ApiController::class,'getProductByTagId']);


Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', [ApiController::class, 'me']);
});

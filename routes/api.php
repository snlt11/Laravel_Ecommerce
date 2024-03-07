<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiController::class, 'login']);

Route::post('/register', [ApiController::class, 'register']);

Route::get('/categories',[ApiController::class, 'categories']);
Route::get('/subcategories/{id}',[ApiController::class, 'subcategories']);

Route::group(['middleware'=>'jwt.auth'],function(){
    Route::get('/me',[ApiController::class, 'me']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'add']);
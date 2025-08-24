<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', fn() => redirect()->route('products.index'));
Route::get('products/{product}/details', [ProductController::class, 'details'])->name('products.details');
Route::resource('products', ProductController::class);
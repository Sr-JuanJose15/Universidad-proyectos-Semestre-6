<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('products', ProductController::class);

// Ruta para mostrar la página de checkout (GET)
Route::get('/checkout', function () {
    $products = \App\Models\Product::all();
    return view('checkout.checkout', compact('products'));
})->name('checkout');

// Ruta para manejar el proceso de checkout (POST)
Route::post('/checkout', [StockMovementController::class, 'checkout'])->name('checkout.process');

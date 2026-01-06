<?php

use App\Http\Controllers\api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockMovementController;

Route::apiResource('products',ProductController::class);
Route::apiResource('stock_movements', StockMovementController::class);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController; // Zid hay krmal el orders

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- 1. Public Routes (Ayya 7ada fiyo y-shoufon) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔍 Search + Pagination + List
Route::get('/products', [ProductController::class, 'index']); 
Route::get('/products/{product}', [ProductController::class, 'show']); 


// --- 2. Protected Routes (Token Required - Auth) ---
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 🛒 Orders: Ayya user 3ando token fiyo yashtre
    Route::post('/orders', [OrderController::class, 'store']);


    // --- 3. Admin ONLY Routes ---
    // Note: T'akkad enno el middleware esmo 'admin' m3arraf bel project
    Route::middleware('admin')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']); 
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    });
});
<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductBuyController;
use App\Http\Controllers\ProductController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/bateches/{id}', [ProductController::class, 'producBatche']);
Route::get('/products/details/{batchId}', [ProductController::class, 'productDetails']);
Route::post('/products/buy',[ProductBuyController::class, 'store']);

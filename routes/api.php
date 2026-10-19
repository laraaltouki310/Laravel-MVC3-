<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// مسارات المنتجات القياسية (index, store, show, update, destroy)
Route::apiResource('products', ProductController::class);

// مسار مخصص لإضافة المنتج إلى السلة
Route::post('/users/{id}/cart', [ProductController::class, 'AddToCard']);

// مسار لعرض المستخدم مع منتجاته
Route::get('/users/{user}', [UserController::class, 'show']);

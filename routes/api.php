<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::prefix('/category-product')->middleware('auth:api')->group(function () {
                                //->middleware(['auth:api', 'checkRole:admin']) bisa di atur per role
    Route::post('/', [CategoryProductController::class, 'create']);
    Route::get('/', [CategoryProductController::class, 'getWithPaginate']);
    Route::get('/{categoryProduct:id}', [CategoryProductController::class, 'getById']);
    Route::put('/{categoryProduct:id}', [CategoryProductController::class, 'updateById']);
});

Route::prefix('/product')->middleware('auth:api')->group(function () {
                                //->middleware(['auth:api', 'checkRole:user']) bisa di atur per role
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/', [ProductController::class, 'getWithPaginate']);
    Route::get('/{product:id}', [ProductController::class, 'getById']);
    Route::put('/{product:id}', [ProductController::class, 'updateById']);
});
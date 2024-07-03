<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/', function(Request $request){
    return response()->json([
        "awd" => $request->bearerToken()
    ]);
})->middleware(['auth:api', 'checkRole:user']);
<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/', function(Request $request){
    return response()->json([
        "awd" => $request->bearerToken()
    ]);
})->middleware(['auth:api', 'checkRole:user']);
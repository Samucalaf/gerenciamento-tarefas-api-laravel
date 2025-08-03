<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function(){
        Route::apiResource('category', CategoryController::class);
});


Route::get('/user', function (Request $request) {
        return $request->user();
})->middleware('auth:sanctum');

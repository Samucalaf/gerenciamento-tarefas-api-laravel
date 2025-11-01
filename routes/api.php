<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {


        Route::get('profile', [UserController::class, 'profile']);



        Route::apiResource('category', CategoryController::class);
        Route::apiResource('task', TaskController::class);
        Route::apiResource('users', UserController::class);
});

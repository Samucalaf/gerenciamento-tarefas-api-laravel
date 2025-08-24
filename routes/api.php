<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TaskController;

Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('task', TaskController::class);
        Route::get('filter', [TaskController::class, 'filter']);
        Route::get('filter', [CategoryController::class, 'filter']);
        Route::get('statisticTaskUser', [DashboardUserController::class, 'statisticTaskUser']);
        Route::get('statisticCategory', [DashboardUserController::class, 'statisticCategory']);
        Route::get('statisticUser', [DashboardUserController::class, 'statisticUser']);
});


Route::get('/user', function (Request $request) {
        return $request->user();
})->middleware('auth:sanctum');

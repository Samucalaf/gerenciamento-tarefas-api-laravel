<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/teste', function () {
    return 'OLá';
});

Route::post('/cadastro', [CadastroController::class, 'cadastroUsuario'])
        ->middleware(EnsureTokenIsValid::class);


Route::post('/login', [AuthController::class, 'login']);

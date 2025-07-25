<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;

Route::get('/teste', function(){
    return 'OLá';
});

Route::post('/cadastro', [CadastroController::class, 'cadastroUsuario'])
    ->middleware('verifica.dados');



Route::post('/login', [AuthController::class, 'login']);
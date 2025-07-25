<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CadastroController;
use Illuminate\Support\Facades\Route;


Route::post('/cadastro', [CadastroController::class, 'store'])->middleware('verifica.dados');





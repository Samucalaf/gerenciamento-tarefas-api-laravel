<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;

Route::post('/cadastro', [CadastroController::class, 'cadastroUsuario'])
    ->middleware('verifica.dados');




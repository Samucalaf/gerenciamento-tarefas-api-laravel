<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/cadastro', function(){
    //vai salvar usuarios na tabela usuarios
});

Route::post('/login', function(){
    return response()->json(['mensagem' => 'Olá']);

    //vai fazer uma pesquisa na tabela para realizar o login 
});



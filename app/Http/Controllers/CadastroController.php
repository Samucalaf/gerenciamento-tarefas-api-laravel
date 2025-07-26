<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CadastroController extends Controller
{
    public function cadastroUsuario(Request $request){
        $nome = $request->input('nome');
        $email = $request->input('email');
        $senha = $request->input('senha');

        $validate = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'nullable|string'
        ]);

        DB::insert('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)', [
            $validate['nome'],
            $validate['email'],
            bcrypt($validate['senha']),
        ]);
        return response()->json(['mensagem' => 'Usuário cadastrado com sucesso!']);
}
}
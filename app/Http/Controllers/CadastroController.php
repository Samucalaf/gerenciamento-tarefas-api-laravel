<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    public function cadastroUsuario(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'nullable|string'
        ]);

        $user = User::create($validate);

        return response()->json([
            'mensagem' => 'Usuário cadastrado com sucesso!',
            'usuario' => $user
        ]);
    }
}

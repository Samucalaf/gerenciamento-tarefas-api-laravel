<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable|string'
            ]);

            $user = User::create($validate);
            $token = $user->createToken('api-token')->plainTextToken;



            return response()->json([
                'mensagem' => 'Usuário cadastrado com sucesso!',
                'usuario' => $user,
                'Token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'Erro!' => $e->getMessage()
            ], 400);
        }
    }

    public function login(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email|',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validate)) {
            $user = User::where('email', $validate['email'])->first();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['mensagem' => 'Login realizado com sucesso', 'token' => $token]);
        } else {
            return response()->json([
                'erro!' => 'Credenciais erradas!'
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['erro' => 'token invalido'], 400);
        }

        //busca pelo token

        $access_token = PersonalAccessToken::findToken($token);

        if (!$access_token) {
            return response()->json(['erro' => 'token invalido'], 400);
        }

        $access_token->delete();
        return response()->json([
            'mensagem' => 'Logout realizado com sucesso!'
        ]);
    }
}

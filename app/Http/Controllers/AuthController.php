<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

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
        }

        return response()->json(['erro' => 'Credenciais invalidas'], 401);
    }

    public function logout() {}



    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login(Request $request){
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json(['mensagem' => 'Login realizado com sucesso']);
        }

        return response()->json(['erro' => 'Credenciais invalidas'], 401);
    }

    public function logout(){

    }



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

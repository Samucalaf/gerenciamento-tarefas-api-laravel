<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*$dados = $request->json()->all();

        $nome = $dados['name'] ?? null;
        $email = $dados['email'] ?? null;
        $senha = $dados['password'] ?? null;


        if (!$nome || !$email || !$senha){
            return response()->json([
                'erro' => 'Nome, email e senha são obrigatórios.'
            ], 422);
        }*/

        return $next($request);
    }
}

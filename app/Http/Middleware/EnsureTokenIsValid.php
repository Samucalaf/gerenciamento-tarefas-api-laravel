<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->expectsJson()) {
            try {
                $this->authenticate($request, $guards);
            } catch (AuthenticationException $e) {
                return response()->json(['message' => 'Token inválido ou expirado'], 401);
            }
        }

        return $next($request);
    }

     protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check()) {
                return auth()->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated', $guards);
    }
}

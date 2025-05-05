<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Authenticate extends Middleware
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        try {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não autenticado'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido ou ausente'], 401);
        }

        return $next($request);
    }
}

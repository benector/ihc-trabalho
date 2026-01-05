<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Garante que o usuário está logado
        if (!auth()->check()) {
            abort(403);
        }

        // Garante que é administrador
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}

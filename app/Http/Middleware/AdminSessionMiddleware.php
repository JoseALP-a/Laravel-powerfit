<?php

namespace App\Http\Middleware;

use Closure;

class AdminSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        // Usa una cookie de sesión distinta para los administradores
        config(['session.cookie' => 'laravel_session_admin']);
        return $next($request);
    }
}

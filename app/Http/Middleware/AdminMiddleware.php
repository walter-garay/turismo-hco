<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es admin
        if (auth()->check() && auth()->user()->rol === 'admin') {
            return $next($request);
        }

        // Redirigir a la página principal si no es admin
        return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}

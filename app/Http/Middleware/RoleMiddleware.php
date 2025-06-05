<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  
     * @param  \Closure  
     * @param  string  
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $rol)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->rol !== $rol) {
            // Si el usuario no tiene el rol requerido
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}

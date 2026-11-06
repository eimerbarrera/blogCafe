<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrEditorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si el usuario está autenticado y si su rol es 'admin' o 'editor'
        if ($request->user() && in_array($request->user()->role, ['admin', 'editor'])) {
            return $next($request);
        }

        // Si no cumple con ninguno de los dos roles, denegamos el acceso (403)
        abort(403, 'Acceso no autorizado. Se requiere rol de Administrador o Editor.');
    }
}

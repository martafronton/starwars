<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolGestor
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && in_array($request->user()->rol, ['admin', 'gestor'])) {
            return $next($request);
        }
        return response()->json(['error' => 'No autorizado'], 403);
    }
}

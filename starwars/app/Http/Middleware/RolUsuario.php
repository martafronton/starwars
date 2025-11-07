<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolUsuario
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            return $next($request);
        }
        return response()->json(['error' => 'No autorizado'], 403);
    }
}


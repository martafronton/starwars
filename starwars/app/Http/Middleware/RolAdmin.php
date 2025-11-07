<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->rol === 'admin') {
            return $next($request);
        }
        return response()->json(['error' => 'No autorizado'], 403);
    }
}


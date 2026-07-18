<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // belum login
        if (!auth()->check()) {
            abort(403);
        }

        // cek apakah role user termasuk role yang diizinkan
        if (!auth()->user()->hasRole(...$roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
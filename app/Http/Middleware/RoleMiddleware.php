<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->ajax()) {
            return redirect()->route('login');
        }

        if (strcasecmp(auth()->user()->role, $role) !== 0) {
            abort(403, 'Akses di tolak. Anda tidak memiliki izin untuk mengakses halaman ini,');
        }

        return $next($request);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            $hasAccess = in_array($userRole, $roles);

            if (!$hasAccess) {
                abort(403, 'You don\'t have the access');
            }
        }

        // Has Access
        return $next($request);
    }
}

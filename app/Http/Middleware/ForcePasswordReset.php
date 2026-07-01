<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordReset
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for unauthenticated users, or if they are already on the setup password routes, or logout
        if (!auth()->check() || 
            $request->routeIs('password.setup') || 
            $request->routeIs('password.setup.store') || 
            $request->routeIs('logout')) {
            return $next($request);
        }

        // If the user requires a password reset, redirect to setup screen
        if (auth()->user()->require_password_reset) {
            return redirect()->route('password.setup');
        }

        return $next($request);
    }
}

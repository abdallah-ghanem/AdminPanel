<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the logged-in user has the specified role
        if (Auth::check() && Auth::user()->role !== $role) {
            // Redirect to a route if the user doesn't have the required role
            return redirect('/users');
        }

        return $next($request);
    }

}

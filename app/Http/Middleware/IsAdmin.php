<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Redirect admins to the admin dashboard
            if (auth()->user()->role === 'admin') {
                return $next($request); // Ensure this route exists
            }else{
                return to_route('user.user');
            }
        }else{// If the user is not authenticated, redirect to login
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Check if user is authenticated and has admin role (role != 1)
     * Regular users have role = 1, Admins have role = 0 or 2
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin area.');
        }

        // Check if user has admin role (role != 1)
        // role = 1 is regular user, other values are admin
        if (auth()->user()->role == 1) {
            // Regular user trying to access admin area
            return redirect('/')->with('error', 'You do not have permission to access admin area.');
        }

        return $next($request);
    }
}

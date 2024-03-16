<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            // Check if the user is authenticated and has the 'admin' role
    if (auth()->check() && auth()->user()->hasRole('admin')) {
        return $next($request);
    }

    // Redirect to a route or show an error message for unauthorized access
    return redirect()->route('login')->with('error', 'Unauthorized access.');
}
    
}

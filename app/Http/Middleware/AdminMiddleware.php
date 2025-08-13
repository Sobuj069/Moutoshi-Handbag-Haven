<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }

        $user = Auth::user();

        // Check if user exists and has admin role
        if (!$user->role || $user->role !== 'admin') {
            abort(403, 'Unauthorized access. Administrator privileges required.');
        }

        return $next($request);
    }
}
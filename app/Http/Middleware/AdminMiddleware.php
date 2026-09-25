<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the admin panel.');
        }

        if (!Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'You do not have permission to access the admin panel.');
        }

        if (!Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}

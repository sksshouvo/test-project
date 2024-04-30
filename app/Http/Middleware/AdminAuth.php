<?php

namespace App\Http\Middleware;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated as an admin
        if (Auth::guard('admin')->check()) {
            \Log::info($request->all());
            // User is authenticated as an admin, allow the request to continue
            return $next($request);
        }

        // If not authenticated as an admin, you can redirect to a login page
        // Example:
        // return redirect()->route('admin.login');

        // Or return an unauthorized response
        return redirect()->route('admin.login');
    }
}

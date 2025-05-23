<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $guard, $userType): Response
    {

        if (!Auth::guard($guard)->check()) {
            return redirect()->route("{$userType}.login")
                ->with('error', 'Please login to access this page.');
        }

        // Logged in but wrong role
        if (Auth::guard($guard)->user()->type !== $userType) {
            return redirect()->route("{$userType}.login")
                ->with('error', 'Please login to access this page.');
        }
         return $next($request);
       // return response()->json(['error' => 'You do not have permission to access this page.'], 403);
    }
}

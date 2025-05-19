<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
       
        if(auth()->user()->type == $userType){
            return $next($request);
        }
          
        return response()->json(['You do not have permission to access for this page.']);
    }
}

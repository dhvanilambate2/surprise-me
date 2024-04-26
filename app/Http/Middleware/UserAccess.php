<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if(auth()->user()->type == $userType){
        //     return $next($request);
        // }
        if (Auth::check()) {
            // Check if the user has the required role
            if (Auth::user()->hasRole($role)) {
                // User has the required role, allow access
                return $next($request);
            }
        }

        // User is not authenticated or doesn't have the required role
        abort(403, 'Unauthorized action.');
          
        // return response()->json(['You do not have permission to access for this page.']);
        /* return response()->view('errors.check-permission'); */
    }
}

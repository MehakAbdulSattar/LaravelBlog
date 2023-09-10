<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next): Response
    {
        // Check if the request is sent by an admin or other
        if (Auth::check()) 
        {
            // '1' represents the Admin Role
            if (Auth::user()->role_as == '1') 
            {
                return $next($request);
            }
            else if (Auth::user()->role_as == '0')
            {
                return redirect('home')->with('status', "Access Denied! You are not an Admin");
            } 
        }
        else
        {
             // If the user is not an admin or not authenticated,
            // redirect to the login page with an error message
            return redirect('home')->with('status', "Login Yourself");
        }
    }
}

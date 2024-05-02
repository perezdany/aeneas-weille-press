<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if($request->routeIs('admin.*'))
            {
                return route('loginAdmin');
            }
            return route('login');
        }

        /*if (Auth::check()) {
            // The user is logged in...
            dd(Auth::check());
        }*/
        //return route('login');

    }

    /*public function handle($request, Closure $next, $guard = null)
    {
    // $guard = 'customer' in this case or any custom guard

    if (Auth::guard($guard)->check()) { } // checks if the user is authenticated

    if (Auth::guard($guard)->id()) {} // gets the id of the authenticated user...

    //...other SessionGuard methods...

    }*/

   
}

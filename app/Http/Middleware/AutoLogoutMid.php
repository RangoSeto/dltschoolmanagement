<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AutoLogoutMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check()){

            $dueinactivetime = config('session.lifetime') * 60; // convert minutes to seconds
            $lastactivity = Session::get('lastactivity',now());

            if(now()->diffInSeconds($lastactivity) > $dueinactivetime){
                Auth::logout();
                Session::flush();

                return redirect()->route('login')->with('message','You have been logged out.');

            }

            // Update the last activity time
            Session::put('lastactivity',now());

        }

        return $next($request);
    }
}


// php artisan make:middleware AutoLogoutMid
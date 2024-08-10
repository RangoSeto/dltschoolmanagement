<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class PostViewDurationMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $post = $request->route('post');
        // dd($post);

        if($post){
            Session::put('entrytime',now());
            Session::put('post_id',$post);
        }

        return $next($request);
    }
}


// php artisan make:middleware PostViewDurationMid

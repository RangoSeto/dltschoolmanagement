<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationStepMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$step): Response
    {

        $regdatas = $request->session()->get('registerationdatas');

        if($step == 'step2' && !$regdatas){
            return redirect()->route('register.step1')->with('error','You must complete step 1.');
        }

        if($step == 'step3' && (!$regdatas || !isset($regdatas['lead']))){
            return redirect()->route('register.step1')->with('error','You must complete step 1 and step2.');
        }

        return $next($request);
    }
}


// php artisan make:middleware CheckRegistrationStepMid
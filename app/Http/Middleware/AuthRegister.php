<?php

namespace App\Http\Middleware;

use Closure;

class AuthRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->get('email') == null){
            return $next($request);
        }
            return redirect()->route('home');

    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        if (Auth::check() && Auth::user() && (Auth::user()->tipo === 'User' || Auth::user()->tipo === 'Admin')) {
            return $next($request);
        }

        // return redirect()->back();
        return redirect()->route('login.index');
    }
}

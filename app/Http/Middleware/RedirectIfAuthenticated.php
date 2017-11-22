<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $type = null)
    {
        if (Auth::check() && Auth::user()->type == $type) {
                return $next($request);
            }
//            else {
//                return redirect()->back()->withErrors(['You dont have permission to access this page']);
//        }

        return $next($request);
    }
}

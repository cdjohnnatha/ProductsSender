<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserAccessType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if(auth()->check() && auth()->user()->type == $type){
            return $next($request);
        } else {
            return redirect()->back()->withErrors(['You dont have permission to access this page']);
        }
    }
}

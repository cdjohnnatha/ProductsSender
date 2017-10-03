<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class Language
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


        $locale = session('locale');
        if(is_null($locale)) {
            $locale = 'en';
        }
        app()->setLocale($locale);
        return $next($request);
    }
}

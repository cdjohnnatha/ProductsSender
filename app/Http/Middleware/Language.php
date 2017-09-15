<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Config;

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
        $locale = Session::(['locale' => config('app.locale')]);
        echo "<script>alert('".$locale."')</script>";
        app()->setLocale($locale);

        return $next($request);
    }
}

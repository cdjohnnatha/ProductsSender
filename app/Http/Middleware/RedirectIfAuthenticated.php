<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
   //TODO: de forma alguma misturar o middleware. Segmentar por rota no arquivo de routes.php o que é de cada um
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'admin':
                if(Auth::guard($guard)->check()) {
                    redirect('/admin/'.Auth::user()->id.'/');
                }
            break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/user/'.Auth::user()->id);
                }
            break;
        }

        return $next($request);
    }
}

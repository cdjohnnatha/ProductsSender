<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as BaseTrimmer;

class TrimStrings extends BaseTrimmer
{
    //TODO: o que é isso? porque não criar uma arquivo Helpers.php para ajudar? Ou até mesmo Support.php (laravel já tem helpers.php)
    protected $except = [
        'password',
        'password_confirmation',
    ];
}

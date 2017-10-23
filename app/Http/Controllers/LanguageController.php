<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function update(Request $request, $locale = 'en')
    {

        if(!in_array($locale, ['en', 'br'])){
            $locale = 'en';
        }

        session(['locale' => $locale]);
        return back();
    }
}
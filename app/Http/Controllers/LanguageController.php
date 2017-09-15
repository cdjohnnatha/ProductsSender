<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function update($locale = 'en')
    {
        if(!in_array($locale, ['en', 'pt-br'])){
            $locale = 'en';
        }

        Session::put('locale', $locale);
        return back();
    }
}

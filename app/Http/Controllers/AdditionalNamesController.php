<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdditionalNamesController extends Controller
{
    public function create()
    {
        return view('user.additionalNames');
    }

    public function register(Request $request)
    {

    }
}

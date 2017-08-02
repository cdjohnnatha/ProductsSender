<?php

namespace App\Http\Controllers;

use App\AdditionalNames;
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

    public function names($id)
    {
        return response()->json([
            'names' => AdditionalNames::where('user_id', $id)
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create($id)
    {
        return view('address.create');
    }

    public function register(Request $request, $id)
    {
        return true;
    }
}

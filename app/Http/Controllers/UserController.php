<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        return response()->json([
            'user' => User::findOrFail($id)
        ]);


    }
}

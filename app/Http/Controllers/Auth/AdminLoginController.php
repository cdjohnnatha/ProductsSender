<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }


    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if(Auth::guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])){
            return response('/admin/dashboard', 202);
        }

        return response('something wrong!', 401);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{


    private function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ];
    }
    public function index()
    {
        return view('auth.admin-login');
    }


    public function login(Request $request)
    {
        $this->validate($request, $this->rules());
        if(Auth::guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])){
            return redirect(route('admin.dashboard'));
        }

        return redirect(route('admin.login'));
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                return redirect()->to('/admin');
            }

            if (auth()->user()->type == 'user') {
                return redirect()->to('/user');
            } else {
                return redirect()->back()->withErrors(['Unknown user!']);
            }
            
        } else {
            return redirect()->route('login');
        }
    }
}
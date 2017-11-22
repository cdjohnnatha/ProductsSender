<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            if (auth()->user()->type == 'user') {
                return redirect()->to('/user/dashboard');
            } else {
                return redirect()->back()->withErrors(['Unknown user!']);
            }
            
        } else {
            return redirect()->route('login');
        }
    }
}

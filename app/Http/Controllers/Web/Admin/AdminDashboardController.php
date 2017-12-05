<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}

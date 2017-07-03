<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function showall()
    {
        return view('user.all')->with('users', User::paginate(15) );
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update()
    {
        return true;
    }
}

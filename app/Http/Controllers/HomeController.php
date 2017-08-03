<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class HomeController extends Controller
{

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

    public function notifications()
    {
        return response()->json([
            'notifications' => Auth::user()->notifications,
            'unreadNotifications' => Auth::user()->unreadNotifications
        ]);
    }

    public function unread()
    {
        return response()->json([
            'unread' => Auth::user()->unreadNotifications
        ]);
    }

    public function markRead()
    {
        Auth::user()->notifications->markAsRead();
    }

    public function showNotifications()
    {
        return view('user.notifications');
    }
}

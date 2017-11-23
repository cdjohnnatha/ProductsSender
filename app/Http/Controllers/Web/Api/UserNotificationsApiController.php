<?php

namespace App\Http\Controllers\Web\Api;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserNotificationsApiController extends Controller
{
    public function unread()
    {
        return response()->json([
            'unread' => Auth::user()->unreadNotifications
        ]);
    }

}

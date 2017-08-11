<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class UserNotificationsController extends Controller
{
    public function index()
    {

        $notifications = Auth::user()->notifications;
        $unreadNotifications = Auth::user()->unreadNotifications;
        return view('user.notifications', compact('notifications', 'unreadNotifications'));
    }

    public function show($id, $id_notification)
    {

        $notification = DatabaseNotification::find($id_notification);
        $package_id = $notification->data['package']['id'];
        return redirect(route('user.packages.show', [$id, $package_id]));
    }

    public function destroy($id, $id_notification)
    {
        $notification = DatabaseNotification::find($id_notification);
        $package_id = $notification->data['package']['id'];
        $notification->markAsRead();
        return redirect(route('user.packages.show', [$id, $package_id]));

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseNotificationsController extends Controller
{

    public function index()
    {
        $notifications = Auth::user()->notifications;
        $unreadNotifications = Auth::user()->unreadNotifications;
        return view('user.notifications', compact('notifications', 'unreadNotifications'));
    }

    public function show($id)
    {
        $notification = DatabaseNotification::find($id);
        return redirect(route('admin.packages.show', [$id]));
    }

    public function update(Request $request, $id)
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        return back();
    }

    public function destroy($id)
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        return redirect(route('admin.packages.show', [$id]));

    }

    public function readShow($id)
    {
        $notification = DatabaseNotification::find($id);
        if(is_null($notification->read_at))
            $notification->markAsRead();

        return redirect(route('admin.packages.show', $notification->data['package']));
    }


    public function markAll()
    {
        Auth::user()->notifications->markAsRead();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        $notifications = Auth::user()->notifications;
        $unreadNotifications = Auth::user()->unreadNotifications;

        return view('user.notifications', compact('notifications', 'unreadNotifications'));
    }

    public function show($id){
        $notification = DatabaseNotification::find($id);

        return redirect(route('user.packages.show', [$id]));
    }

    public function update(Request $request, $id){
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();

        return back();
    }

    public function destroy($id){
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();

        return redirect(route('user.packages.show', [$id]));
    }

    public function readShow($id)
    {
        $notification = DatabaseNotification::find($id);
        if(is_null($notification->read_at))
            $notification->markAsRead();

        return redirect(route('user.packages.show', $notification->data['package']));
    }

    public function unread(){
        return response()->json([
            'unread' => Auth::user()->unreadNotifications
        ]);
    }

    public function markAll(){
        Auth::user()->notifications->markAsRead();

        return back();
    }
}

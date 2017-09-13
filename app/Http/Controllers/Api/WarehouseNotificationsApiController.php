<?php

namespace App\Http\Controllers\Api;

use App\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WarehouseNotificationsApiController extends Controller
{
    public function unread()
    {
        $warehouse = Warehouse::find(Auth::user()->warehouse_id);
        return response()->json([
            'unread' => $warehouse->unreadNotifications
        ]);
    }

}

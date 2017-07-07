<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        return response()->json([
            'subscriptions' => DB::table('subscriptions')->select('id', 'name', 'amount')->get(),
        ])->setStatusCode(200);
    }
}

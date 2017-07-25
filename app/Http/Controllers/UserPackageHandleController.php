<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPackageHandleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function table()
    {
        return view('package.userPackageList');
    }

    public function userDefaultPackages()
    {
        $packages =  Package::with(['status' => function($query){
            $query->where([
                ['status', 'like', 'WAREHOUSE%'],
                ['status', '!=', 'WAREHOUSE_SENT'],
            ]);
        }])->where('object_owner', '=', Auth::user()->id)->get();
        $packages->load('pictures');
        return response()->json([
            'packages' => $packages
        ]);
    }

    public function notifiedPackages()
    {
        $packages =  Package::with(['status' => function($query){
            $query->where([
                ['status', 'like', 'WAREHOUSE_NOTIFY_USER']
            ]);
        }])->where('object_owner', '=', Auth::user()->id)->get();

        return response()->json([
            'packages' => $packages
        ]);
    }


}

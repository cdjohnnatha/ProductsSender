<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function unread()
    {
        $packages =  Package::select('id', 'warehouse_id', 'object_owner', 'read')
            ->where('read',true)
            ->where('object_owner', '=', Auth::user()->id)->get();

        $packages->load( ['warehouse' => function($query){
            $query->select('name', 'id');
        }]);

        return response()->json([
            'unread' => $packages
        ]);
    }

    public function read($id, $idPackage)
    {
        $package = Package::findOrFail($idPackage);
        $package->read = true;
        $package->save();

        return response('read', 200);
    }


}

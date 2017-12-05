<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Support\Facades\Auth;

class UserPackageController extends Controller
{
    public function index()
    {
        $packages =  Package::with(['status' => function($query) {
            $query->where([
                ['status', 'like', 'WAREHOUSE%'],
                ['status', '!=', 'WAREHOUSE_SENT'],
            ]);
            },
            'pictures',
            'warehouse'])
            ->where('object_owner', '=', Auth::user()->id)->get();

        return view('package.user-index', compact('packages'));

    }

    public function show($id)
    {
        $package = Package::findOrFail($id);

        return view('package.show', compact('package'));
    }

    public function informPackage()
    {
        return view('package.inform');
    }
}

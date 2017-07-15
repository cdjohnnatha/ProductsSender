<?php

namespace App\Http\Controllers;

use App\Package;
use App\Status;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function form()
    {
        return view('package.form');
    }

    public function register(Request $request)
    {
        $package = new Package();
        $package->width = $request->input('width');
        $package->height = $request->input('height');
        $package->depth = $request->input('depth');
        $package->weight = $request->input('weight');
        $package->unit_measure = $request->input('unit_measure');
        $package->weight_measure = $request->input('weight_measure');
        $package->note = $request->input('note');
        if(is_null($package->note))
            $package->note = '';
        $package->status_id = $request->input('status_id');
        $package->object_owner = $request->input('object_owner');
        $package->warehouse_id = $request->input('warehouse_id');

        if($package->save()){
            return response('created',201);
        }

        return response('', 406);
    }
}

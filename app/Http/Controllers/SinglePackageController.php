<?php

namespace App\Http\Controllers;

use App\Package;
use App\Service;
use Illuminate\Http\Request;

class SinglePackageController extends Controller
{
    //TODO: qual o motivo desse controlador? porque não ficar em package?
    public function create($id){
        $package = Package::find($id);
        $services = Service::all();

        return view('package.single.create', compact('package', 'services'));
    }

}

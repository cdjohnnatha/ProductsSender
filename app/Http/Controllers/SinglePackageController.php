<?php

namespace App\Http\Controllers;

use App\Package;
use App\Service;
use Illuminate\Http\Request;

class SinglePackageController extends Controller
{

    public function create($id)
    {
        $package = Package::find($id);
        $services = Service::all();
        return view('package.single.create', compact('package', 'services'));
    }

}

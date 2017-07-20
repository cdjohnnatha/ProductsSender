<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageFiles;
use App\Status;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{

    private $path;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'public/PackagePictures/';
    }

    public function form($id = 0)
    {
        return view('package.form')->with('id', $id);
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

            $files = $request->input('pictures');
            if(!is_null($files)) {
                foreach ($files as $file) {
                    $fileName =  $package->id . date("dmYhms");
                    $fileName = md5($fileName);
                    $exploded = explode(',', $file);
                    $decoded = base64_decode($exploded[1]);
                    if (str_contains($exploded[0], 'jpg')) {
                        $extension = 'jpg';
                    }
                    if (str_contains($exploded[0], 'jpeg')) {
                        $extension = 'jpeg';
                    }
                    if (str_contains($exploded[0], 'png')) {
                        $extension = 'png';
                    } else {
                        return response('Format not accepted', 405);
                    }
                    $name = $fileName.'.'.$extension;
                    Storage::put($this->path.$name, $decoded);
                    $picture = new PackageFiles();
                    $picture->name = $name;
                    $picture->type = $extension;
                    $picture->path = $this->path;

                    $package->pictures()->save($picture);

                }
            }
            return response('created',201);
        }
        return response()->setStatusCode(406);
    }

    public function showList()
    {
        return view('package.list');
    }

    public function warehousePackages()
    {
        $packages = Package::with(['status' => function($query){
            $query->where([
            ['status', 'like', 'WAREHOUSE%'],
            ['status', '!=', 'WAREHOUSE_SENT'],
            ]);
        }])->where('warehouse_id', '=', Auth::user()->default_warehouse_id)->get();
        return response()->json([
           'packages' => $packages
        ]);

    }

    public function showView($id)
    {
        return view('package.show')->with('id', $id);
    }

    public function show($id)
    {
        $contents = Storage::url($this->path.'3919072017020756.jpeg');
        Log::info($contents);
        $package = Package::find($id);
        $package->load('pictures');
        $package->load('warehouse');
        $package->load('status');
        $package->load('user');
        Storage::delete('public/PackagePictures/3917072017.png');
        return response()->json([
           'package' => $package
        ]);
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->width = $request->input('width');
        $package->height = $request->input('height');
        $package->depth = $request->input('depth');
        $package->weight = $request->input('weight');
        $package->unit_measure = $request->input('unit_measure');
        $package->weight_measure = $request->input('weight_measure');
        $package->note = $request->input('note');
        if(is_null($package->note))
            $package->note = '';
        $package->status_id = $request->input('status.id');
        $package->object_owner = $request->input('object_owner');
        $package->warehouse_id = $request->input('warehouse.id');
        if($package->save()){
            $files = $request->input('pictures');
            if(!is_null($files)) {
                foreach ($files as $file) {
                    $fileName =  $package->id . date("dmYhms");
                    $fileName = md5($fileName);
                    $exploded = explode(',', $file);
                    $decoded = base64_decode($exploded[1]);
                    $extension = '';
                    if (str_contains($exploded[0], 'jpg')) {
                        $extension = 'jpg';
                    }
                    else if (str_contains($exploded[0], 'jpeg')) {
                        $extension = 'jpeg';
                    }
                    else if (str_contains($exploded[0], 'png')) {
                        $extension = 'png';
                    }
                    else {
                        return response('Format not accepted', 405);
                    }
                    $name = $fileName.'.'.$extension;
                    Storage::put($this->path.$name, $decoded);
                    $picture = new PackageFiles();
                    $picture->name = $name;
                    $picture->type = $extension;
                    $picture->path = 'storage/PackagePictures/';
                    $package->pictures()->save($picture);
                }
            }
            return response('created',201);
        }
        return response()->setStatusCode(406);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->load('pictures');
        Log::info($package);
        if(!is_null($package->pictures)){
            foreach($package->pictures as $picture){
                Storage::delete('public/PackagePictures/'.$picture->name);;
            }
        }
        $package->delete();
        if($package->trashed()){
            return response('public/PackagePictures/show-list', 200);
        }

        return response('error while deleting at database', 417);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Events\PackageNotification;
use App\Notifications\PackageNotifications;
use App\Package;
use App\PackageFiles;
use App\Status;
use App\User;
use App\Warehouse;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class PackageController extends Controller
{

    public function rules()
    {
        return [
            'package.width' => 'required',
            'package.height' => 'required',
            'package.depth' => 'required',
            'package.weight' => 'required',
            'package.unit_measure' => 'required',
            'package.weight_measure' => 'required',
            'package.object_owner' => 'required',
            'warehouse_id' => 'required',
            'status.status_id' => 'required|min:1'
        ];
    }

    public function index()
    {
        $packages = Package::with(
            ['status' =>
                function($query){
                    $query->where([
                        ['status', 'like', 'WAREHOUSE%'],
                        ['status', '!=', 'WAREHOUSE_SENT'],
                    ]);
                }])->where(
            'warehouse_id',
            '=',
            Auth::user()->warehouse_id
        )->get();
        $packages->load('status');
        $packages->load('pictures');
        return view('package.index', compact('packages'));
    }

    public function create()
    {
        $warehouses = Warehouse::with('address')->get();
        $status = Status::all();
        return view('package.create', compact('warehouses', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $package = new Package($request->input('package'));
        $package->status_id = $request->input('status.status_id');
        $package->warehouse_id = $request->input('warehouse_id');
        if($package->save()){
            if($request->hasFile('package_files')) {
                foreach ($request->file('package_files') as $file) {
                    $fileName = $package->id . date("dmYhms");
                    $extension = explode('.', $file->getClientOriginalName())[1];
                    $fileName = md5($fileName) . '.' . $extension;
                    $path = $file->storeAs(
                        'public/PackagePictures', $fileName
                    );
                    $path = str_replace('public', 'storage', $path);
                    $picture = new PackageFiles();
                    $picture->name = $fileName;
                    $picture->path = $path;
                    if ($package->pictures()->save($picture)) {
                        activity()
                            ->performedOn($package)
                            ->causedBy(Auth::user())
                            ->withProperty('package_id', $package->id)
                            ->withProperty('file_name', $fileName)
                            ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
                    }
                }
            }
            return redirect(route('admin.packages.index'));
        }

    }

    public function warehousePackages()
    {
        $packages = Package::with(
            ['status' =>
                function($query){
                    $query->where([
                        ['status', 'like', 'WAREHOUSE%'],
                        ['status', '!=', 'WAREHOUSE_SENT'],
                    ]);
            }])->where(
            'warehouse_id',
            '=',
            Auth::user()->default_warehouse_id
        )->get();

        return response()->json([
           'packages' => $packages
        ]);

    }


    public function show($id)
    {
        $package = Package::find($id);
        $package->load('pictures');
        $package->load('warehouse');
        $package->load('status');
        $package->load('user');
        return view('package.show', compact('package'));
    }

    public function edit($id)
    {
        $package = Package::find($id);
        $package->load('pictures');
        $status = Status::all();
        $warehouses = Warehouse::all();
        $warehouses->load('address');
        return view('package.create', compact('package', 'status', 'warehouses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $package = new Package($request->input('package'));
        $package->status_id = $request->input('status.status_id');
        $package->warehouse_id = $request->input('warehouse_id');

        if($package->save()){
            if($request->hasFile('package_files')) {
                foreach ($request->file('package_files') as $file) {
                    $fileName = $package->id . date("dmYhms");
                    $extension = explode('.', $file->getClientOriginalName())[1];
                    $fileName = md5($fileName) . '.' . $extension;
                    $path = $file->storeAs('public/PackagePictures', $fileName);
                    $path = str_replace('public', 'storage', $path);
                    $picture = new PackageFiles();
                    $picture->name = $fileName;
                    $picture->path = $path;
                    if ($package->pictures()->save($picture)) {
                        activity()
                            ->performedOn($package)
                            ->causedBy(Auth::user())
                            ->withProperty('package_id', $package->id)
                            ->withProperty('file_name', $fileName)
                            ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
                    }
                }
            }


            return redirect(route('admin.packages.index'));
        }
    }

    public function changeStatus(Request $request)
    {
        $package = Package::findOrFail($request->input('id'));
        $status = Status::where('status', $request->input('status'));
        $package->status_id = $status->id;

        if($package->save()){
            return response('status updated to '.$status->status, '200');
        }
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->load('pictures');
        if(!is_null($package->pictures)){
            foreach($package->pictures as $picture){
                Storage::delete(config('constants.files.full_public_path').$picture->name);
                activity()
                    ->performedOn($picture)
                    ->withProperty('package_id', $id)
                    ->withProperty('file_name', $picture->name)
                    ->log('The package id is :properties.package_id, 
                            removing filename :properties.file_name');
            }
        }
        $package->delete();
        if($package->trashed()){
            return redirect(route('admin.packages.index'));
        }
    }


}

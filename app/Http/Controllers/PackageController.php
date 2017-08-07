<?php

namespace App\Http\Controllers;

use App\Events\PackageNotification;
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
            'width' => 'required',
            'height' => 'required',
            'depth' => 'required',
            'weight' => 'required',
            'unit_measure' => 'required',
            'weight_measure' => 'required',
            'object_owner' => 'required',
            'warehouse_id' => 'required',
            'status_id' => 'required'
        ];
    }

    public function index()
    {
        $packages = Package::all();
        $packages->load('status');
        return view('package.index', compact('packages'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        $status = Status::all();
        return view('package.create', compact('warehouses', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $package = new Package($request->all());
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
            event(new PackageNotification($package));
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

    public function showView($id, $packageId)
    {
        return view('package.show')->with('id', $packageId);
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
                    Storage::put(
                        config('constants.files.full_public_path').$name,
                        $decoded
                    );
                    $picture = new PackageFiles();
                    $picture->name = $name;
                    $picture->type = $extension;
                    $picture->path = config('constants.files.full_default_folder');
                    if($package->pictures()->save($picture)){
                        activity()
                            ->performedOn($package)
                            ->causedBy(Auth::user())
                            ->withProperty('package_id', $package->id)
                            ->withProperty('file_name', $name)
                            ->log('The package id is :properties.package_id, 
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name 
                            with id:');
                    }
                }

            }
            event(new PackageNotification($package));
            return response('created',201);
        }
        return response()->setStatusCode(406);
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
            return response('/admin/packages/show-list', 200);
        }
    }


}

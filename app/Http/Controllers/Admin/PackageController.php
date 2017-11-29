<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Events\PackageNotification;
use App\IncomingPackages;
use App\Notifications\PackageNotifications;
use App\Package;
use App\PackageFiles;
use App\Repositories\PackageRepository;
use App\Repositories\WarehouseRepository;
use App\Status;
use App\User;
use App\CompanyWarehouse;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class PackageController extends Controller
{

    private $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

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
        if (auth()->guard('web')->user()){
            $sent = $this->packageRepository->getUserPackagesWithGoods('object_owner', Auth::user()->id, true);
            $incomingPackages = Auth::user()->incomingPackages()->where('registered', false)->get();

        } else {
            $incomingPackages = IncomingPackages::where('registered', false)
                ->where(
                    'warehouse_id',
                    Auth::user()->warehouse_id)
                ->get();
        }


        $packages_warehouse = $this->packageRepository->getIndexPackages(
            'warehouse_id',
            Auth::user()->warehouse_id,
            false);

        if (auth()->guard('web')->user()) {
            return view('package.index_user', compact('packages_warehouse', 'sent', 'incomingPackages'));
        } else {
            return view('package.index', compact('packages_warehouse', 'incomingPackages'));
        }
    }

    public function create($incoming = null){
        $warehouses = $this->warehouse_repository->getAll();
        $status = Status::all();

        $incoming = IncomingPackages::find($incoming ?? 0);

        return view('package.create', compact('warehouses', 'status', 'incoming'));
    }

    public function store(Request $request){
        dd($request->input());
        $this->validate($request, $this->rules());


        $request->session()->flash('status', 'Package was successfully registered at company_warehouse!');

        return redirect(route('admin.packages.index'));
    }


    public function show($id){
        $package = Package::with([
            'pictures',
            'company_warehouse',
            'status',
            'user',
            'goods'])->find($id);

        return view('package.show', compact('package'));
    }

    public function edit($id){
        $package = Package::with(['pictures', 'goods'])->find($id);
        $status = Status::all();
        $warehouses = CompanyWarehouse::all();
        $warehouses->load('address');

        return view('package.create', compact('package', 'status', 'warehouses'));
    }

    public function update(Request $request, $id){
        $this->validate($request, $this->rules());

        $package = Package::findOrFail($id);
        $package->fill($request->input('package'));
        $package->status_id = $request->input('status.status_id');
        $package->warehouse_id = $request->input('warehouse_id');

        if($package->save()){
            if($request->hasFile('package_files')) {
                $this->saveImage($request->file('package_files'), $package);
            }

            $request->session()->flash('status', 'Package #'.$package->id.' was successfully updated!');
            return redirect(route('admin.packages.index'));
        }
    }


    public function destroy($id){
        Package::findOrFail($id)->delete();

        if (auth()->guard('web')->user())
            return redirect(route('user.packages.index'));

        return redirect(route('admin.packages.index'));
    }

    public function changeStatus(Request $request){
        $package = Package::findOrFail($request->input('id'));
        $status = Status::where('status', $request->input('status'));

        $package->status_id = $status->id;
        $package->save();

        return response('status updated to '.$status->status, '200');
    }

    private function saveImage($files, $package){
        foreach ($files as $key=>$file) {
            $fileName = $package->id . date("dmYhmsu");
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = md5($fileName.$key) . '.' . $extension;
            $path = $file->storeAs('public/PackagePictures', $fileName);
            $path = str_replace('public', 'storage', $path);
            $picture = new PackageFiles();
            $picture->name = $fileName;
            $picture->path = '/'.$path;
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

}

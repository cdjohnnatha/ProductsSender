<?php

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\Controller;
use App\Package;
use App\PackageStatus;
use App\Repositories\CompanyWarehouseRepository;
use App\Repositories\PackageRepository;
use App\CompanyWarehouse;
use Illuminate\Http\Request;


//TODO packageStatusRepository
class PackagesController extends Controller
{

    private $packageRepository;
    private $warehouseRepository;
    private $packageStatusRepository;

    public function __construct(
        PackageRepository $packageRepository,
        CompanyWarehouseRepository $companyWarehouseRepository
    )
    {
        $this->packageRepository = $packageRepository;
        $this->warehouseRepository = $companyWarehouseRepository;
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
            'package.client_id' => 'required',
            'package.company_warehouse_id' => 'required',
            'package.package_status_id' => 'required|min:1',
            'package_files.*' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,application/pdf|max:5000'
        ];
    }

    public function index()
    {
        $indexPackages = $this->packageRepository->getPackagesByStatus('REGISTERED');
        $incomingPackages = $this->packageRepository->getPackagesByStatus('INCOMING');
        return view('package.admin.index', compact('indexPackages', 'incomingPackages'));
    }

    public function create()
    {
        $warehouses = $this->warehouseRepository->getAll();
        $packageStatus = PackageStatus::all();

        return view('package.admin.create', compact('warehouses', 'packageStatus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $package = $this->packageRepository->store($request);
        if($package) {
//        $request->session()->flash('status', 'Package was successfully registered at company_warehouse!');
            return redirect(route('admin.packages.index'));
        }
    }


    public function show($id)
    {

        $package = $this->packageRepository->findById($id);
        return view('package.show', compact('package'));
    }

    public function edit($id){
        $package = $this->packageRepository->findById($id);
        $packageStatus = PackageStatus::all();
        $warehouses = $this->warehouseRepository->getAll();
        return view('package.admin.create', compact('package', 'packageStatus', 'warehouses'));
    }

    public function update(Request $request, $id){
        $this->validate($request, $this->rules());

//        $request->session()->flash('status', 'Package #'.$package->id.' was successfully updated!');
        return redirect(route('admin.packages.index'));

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



}

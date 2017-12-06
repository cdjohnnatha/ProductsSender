<?php

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\CompanyWarehouseRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PackageStatusRepository;
use Illuminate\Http\Request;

class PackagesController extends Controller
{

    private $packageRepository;
    private $warehouseRepository;
    private $packageStatusRepository;

    public function __construct(
        PackageRepository $packageRepository,
        CompanyWarehouseRepository $companyWarehouseRepository,
        PackageStatusRepository $packageStatusRepository
    )
    {
        $this->packageRepository = $packageRepository;
        $this->warehouseRepository = $companyWarehouseRepository;
        $this->packageStatusRepository = $packageStatusRepository;
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
        $packageStatus = $this->packageStatusRepository->getAll();

        return view('package.admin.create', compact('warehouses', 'packageStatus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $package = $this->packageRepository->store($request);
        if($package) {
        $request->session()->flash('success', 'Package was successfully registered at Warehouse!');
            return redirect(route('admin.packages.index'));
        }
    }


    public function show($id)
    {
        $package = $this->packageRepository->findById($id);
        return view('package.show', compact('package'));
    }

    public function edit($id)
    {
        $package = $this->packageRepository->findById($id);
        $packageStatus = $this->packageStatusRepository->getAll();
        $warehouses = $this->warehouseRepository->getAll();

        return view('package.admin.create', compact('package', 'packageStatus', 'warehouses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $this->packageRepository->update($id, $request);
        $request->session()->flash('success', 'Package was successfully updated!');

        return redirect(route('admin.packages.index'));

    }


    public function destroy($id)
    {

        $this->packageRepository->destroy($id);
        return redirect(route('admin.packages.index'));
    }
}

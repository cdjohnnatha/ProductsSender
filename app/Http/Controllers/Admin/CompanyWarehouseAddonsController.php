<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CompanyRepository;
use App\Repositories\CompanyWarehouseAddonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyWarehouseAddonsController extends Controller
{
    private $companyWarehouseAddonRepository;
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository, CompanyWarehouseAddonRepository $companyWarehouseAddonRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companyWarehouseAddonRepository = $companyWarehouseAddonRepository;
    }

    public function index()
    {
        $addons = $this->companyWarehouseAddonRepository->getAll();
        return view('company.warehouse.addon.index', compact('addons'));
    }

    public function create($companyId, $warehouseId)
    {
        $companyAddons = $this->companyRepository->getAddons($companyId);
        return view('company.warehouse.addon.create', compact('companyId', 'warehouseId', 'companyAddons'));
    }

    public function store(Request $request, $companyId, $warehouseId)
    {
        $this->validate($request, [
            'price' => 'required|min:0',
            'company_warehouse_id' => 'required|min:1',
            'company_addons_id' => 'required|min:1',
        ]);
        if($this->companyWarehouseAddonRepository->store($request, $warehouseId)){
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($companyId, $warehouseId, $id)
    {
        $companyAddons = $this->companyRepository->getAddons($companyId);
        $warehouseAddon = $this->companyWarehouseAddonRepository->findById($id);
        return view('company.warehouse.addon.create',
            compact('companyId', 'warehouseId', 'companyAddons', 'warehouseAddon'));

    }


    public function update(Request $request, $companyId, $warehouseId, $id)
    {
        if($this->companyWarehouseAddonRepository->update($id, $request)) {
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }
    }

    public function destroy($companyId, $warehouseId, $id)
    {
        if($this->companyWarehouseAddonRepository->destroy($id)){
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }
    }
}

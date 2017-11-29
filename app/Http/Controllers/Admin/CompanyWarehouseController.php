<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\ClientAddressGeoname;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\WarehouseRepository;
use App\CompanyWarehouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyWarehouseController extends Controller
{

    private $warehouseRepository;
    private $companyRepository;

    public function __construct(WarehouseRepository $warehouseRepository, CompanyRepository $companyRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $company_warehouses = $this->warehouseRepository->getAll();
        $companies = $this->companyRepository->getAll();
        return view('company_warehouse.index', compact('company_warehouses', 'companies'));
    }

    public function create()
    {
        $companies = $this->companyRepository->getAll();
        return view('company_warehouse.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_warehouse.storage_time' => 'required|min:0',
            'company_warehouse.box_price' => 'required|min:0',
            'company_warehouse.name' => 'required|string',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required|min:3',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'phones' => 'required|array|min:1',
        ]);

        $this->warehouseRepository->store($request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully created!');
        return redirect(route('admin.company-warehouses.index'));
    }



    public function edit($id)
    {
        $company_warehouse = $this->warehouseRepository->findById($id);
        $companies = $this->companyRepository->getAll();
        return view('company_warehouse.create', compact('company_warehouse', 'companies'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->input());
        $this->validate($request, [
            'company_warehouse.storage_time' => 'required|min:0',
            'company_warehouse.box_price' => 'required|min:0',
            'company_warehouse.name' => 'required|string',
            'company_warehouse.company_id' => 'required',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
        ]);

        $this->warehouseRepository->update($id, $request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully updated!');
        return redirect(route('admin.company-warehouses.index'));
    }

    public function destroy($id)
    {
        if($this->warehouseRepository->destroy($id)) {
            return redirect(route('admin.company-warehouses.index'));
        }

    }
}

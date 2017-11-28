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

    private $warehouse_repository;
    private $company_repository;

    public function __construct(WarehouseRepository $warehouse_repository, CompanyRepository $company_repository)
    {
        $this->warehouse_repository = $warehouse_repository;
        $this->company_repository = $company_repository;
    }

    public function index()
    {
        $company_warehouses = $this->warehouse_repository->getAll();
        $companies = $this->company_repository->getAll();
        return view('company_warehouse.index', compact('company_warehouses', 'companies'));
    }

    public function create()
    {
        $companies = $this->company_repository->getAll();
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

        $this->warehouse_repository->store($request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully created!');
        return redirect(route('admin.company-warehouses.index'));
    }



    public function edit($id)
    {
        $company_warehouse = $this->warehouse_repository->findById($id);
        $companies = $this->company_repository->getAll();
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

        $this->warehouse_repository->update($id, $request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully updated!');
        return redirect(route('admin.company-warehouses.index'));
    }

    public function destroy($id)
    {
        if($this->warehouse_repository->destroy($id)) {
            return redirect(route('admin.company-warehouses.index'));
        }

    }
}

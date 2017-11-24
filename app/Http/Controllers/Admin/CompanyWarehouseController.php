<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\ClientAddressGeoname;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\WarehouseRepository;
use App\CompanyWarehouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyWarehouseController extends Controller
{

    private $warehouse_repository;

    public function __construct(WarehouseRepository $warehouse_repository)
    {
        $this->warehouse_repository = $warehouse_repository;
    }

    public function index()
    {
        $warehouses = $this->warehouse_repository->getAll();
        return view('company_warehouse.index', compact('warehouses'));
    }

    public function create(){

        return view('company_warehouse.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'warehouse.storage_time' => 'required|min:0',
            'warehouse.box_price' => 'required|min:0',
            'address.label' => 'bail|required|min:3',
            'address.phone' => 'required',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required|min:3',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
            'geonames.country' => 'required'
        ]);

        $this->warehouse_repository->store($request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully created!');
        return redirect(route('admin.warehouses.index'));
    }



    public function edit($id){
        $warehouse = $this->warehouse_repository->findById($id);
        $admins = $this->admin_repository->getAll();

        return view('warehouse.create', compact('warehouse', 'admins'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'warehouse.storage_time' => 'required|min:0',
            'warehouse.box_price' => 'required|min:0',
            'address.label' => 'bail|required|min:3',
            'admin_id' => 'required|min:1',
            'address.phone' => 'required',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required|min:3',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
            'geonames.country' => 'required'
        ]);

        $this->warehouse_repository->update($id, $request);

        $request->session()->flash('success', 'CompanyWarehouse was successfully updated!');
        return redirect(route('admin.warehouses.index'));
    }

    public function destroy($id)
    {
        if($this->warehouse_repository->destroy($id)) {
            return redirect(route('admin.warehouses.index'));
        }

    }
}

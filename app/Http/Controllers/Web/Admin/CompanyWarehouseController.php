<?php

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\CompanyWarehouseRepository;
use Illuminate\Http\Request;

class CompanyWarehouseController extends Controller
{

    private $warehouseRepository;

    public function __construct(CompanyWarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function index()
    {

        return view('company.warehouse.index');
    }

    public function create($companyId)
    {
        return view('company.warehouse.create', compact('companyId'));
    }

    public function store(Request $request, $companyId)
    {
        $this->validate($request, [
            'companyWarehouse.storage_time' => 'required|min:0',
            'companyWarehouse.box_price' => 'required|min:0',
            'companyWarehouse.name' => 'required|string',
            'companyWarehouse.company_id' => 'required',
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
        return redirect(route('admin.companies.show', $companyId));
    }

    public function show($companyId, $id)
    {
        $data['companyWarehouse'] = $this->warehouseRepository->findById($id);
        $data['companyId'] = $companyId;
        return view('company.warehouse.show', compact('data'));
    }


    public function edit($companyId, $id)
    {
        $companyWarehouse = $this->warehouseRepository->findById($id);
        return view('company.warehouse.create', compact('companyWarehouse', 'companyId'));
    }

    public function update(Request $request, $companyId, $id)
    {
        $this->validate($request, [
            'companyWarehouse.storage_time' => 'required|min:0',
            'companyWarehouse.box_price' => 'required|min:0',
            'companyWarehouse.name' => 'required|string',
            'companyWarehouse.company_id' => 'required',
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
        return redirect(route('admin.companies.show', $companyId));
    }

    public function destroy($companyId, $id)
    {
        if($this->warehouseRepository->destroy($id)) {
            return redirect(route('admin.companies.warehouses.show', $companyId));
        }

    }
}

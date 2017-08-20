<?php

namespace App\Http\Controllers;

use App\Address;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{

    private function rules()
    {
        return [
            'warehouse.storage_time' => 'required|numeric',
            'warehouse.box_price' => 'required|numeric',
            'address.label' => 'bail|required|min:3',
            'address.owner_name' => 'required',
            'address.owner_surname' => 'required',
            'address.phone' => 'required',
            'address.company_name' => 'nullable',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required|min:3',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'address.default_address' => 'boolean'
        ];
    }

    public function index()
    {
        $warehouses = Warehouse::with('address')->get();
        return view('warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $warehouse = new Warehouse($request->input('warehouse'));

        $address = new Address($request->input('address'));
        $address->default_address = true;

        if($warehouse->save() && $warehouse->address()->save($address)){
            return redirect(route('admin.warehouses.index'));
        }
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->address;
        return response()->json([
            'warehouse' => $warehouse
        ]);
    }

    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->load('address');
        return view('warehouse.create', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->load('address');
        $warehouse->fill($request->input('warehouse'));
        $warehouse->address->fill($request->input('address'));

        if($warehouse->save() &&  $warehouse->address->save()){
            return redirect(route('admin.warehouses.index'));
        }
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        if($warehouse->trashed()){
            return redirect(route('admin.warehouses.index'));
        }

    }
}

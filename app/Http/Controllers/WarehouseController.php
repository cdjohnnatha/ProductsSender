<?php

namespace App\Http\Controllers;

use App\Address;
use App\AddressGeonameCode;
use App\Admin;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{

    public function rules()
    {
        return [
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
            'address.default_address' => 'boolean',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
            'geonames.country' => 'required'
        ];
    }

    public function index()
    {
        $warehouses = Warehouse::with('address')->get();
        return view('warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        $admins = Admin::all();
        return view('warehouse.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $warehouse = new Warehouse($request->input('warehouse'));
        $address = new Address($request->input('address'));
        $geonames = new AddressGeonameCode($request->input('geonames'));
        $admin = Admin::find($request->input('admin_id'));
        $address->owner_name = $admin->name;
        $address->owner_surname = $admin->surname;
        $address->default_address = true;
        $address->company_name = 'Holyship';
        if($warehouse->save() && $warehouse->address()->save($address)
            && $warehouse->address->geonames()->save($geonames)){
            $request->session()->flash('status', 'Warehouse was successfully created!');
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
        $warehouse = Warehouse::with('address')->findOrFail($id);
        $admins = Admin::all();
        $warehouse->address->geonameCode;

        return view('warehouse.create', compact('warehouse', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->load('address');
        $warehouse->address->load('geonames');
        $warehouse->fill($request->input('warehouse'));
        $warehouse->address->fill($request->input('address'));
        $warehouse->address->geonames->fill($request->input('geonames'));


        if($warehouse->save() &&  $warehouse->address->save() && $warehouse->address->geonames->save()){
            $request->session()->flash('status', 'Warehouse #'.$warehouse->id.' was successfully updated!');
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

<?php

namespace App\Http\Controllers;

use App\Address;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{


    public function index()
    {
        $warehouses = Warehouse::with('address')->get();
        return view('warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function register(Request $request)
    {   $warehouse = new Warehouse();
        $warehouse->name = $request->input('name');
        $warehouse->storage_time = $request->input('storage_time');
        $warehouse->box_price = $request->input('box_price');
        $warehouse->updated_by = Auth::user()->id;
        $warehouse->created_by = Auth::user()->id;

        $address = new Address();
        $address->label = $request->input('address.label');
        $address->owner_name = $request->input('address.owner_name');
        $address->owner_surname = $request->input('address.owner_surname');
        $address->company_name = $request->input('address.company');

        if(is_null($address->company_name))
            $address->company_name = '';
        $address->country = $request->input('address.country');
        $address->address = $request->input('address.address');
        $address->city = $request->input('address.city');
        $address->state = $request->input('address.state');
        $address->postal_code = $request->input('address.postal_code');
        $address->phone = ''.$request->input('address.phone');
        $address->default_address = true;

        if($warehouse->save()){
            if( $warehouse->address()->save($address) ){
                return response('/admin/warehouses/show-list', 201);
            }
        }
        return response('', 401);
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

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->load('address');
        $warehouse->name = $request->input('name');
        $warehouse->storage_time = $request->input('storage_time');
        $warehouse->box_price = $request->input('box_price');
        $warehouse->updated_by = Auth::user()->id;
        $warehouse->created_by = Auth::user()->id;


        $warehouse->address->label = $request->input('label');
        $warehouse->address->owner_name = $request->input('owner_name');
        $warehouse->address->owner_surname = $request->input('owner_surname');
        $warehouse->address->company_name = $request->input('company');

        if(is_null($warehouse->address->company_name))
            $warehouse->address->company_name = '';
        $warehouse->address->country = $request->input('country');
        $warehouse->address->address = $request->input('address');
        $warehouse->address->city = $request->input('city');
        $warehouse->address->state = $request->input('state');
        $warehouse->address->postal_code = $request->input('postal_code');
        $warehouse->address->phone = ''.$request->input('phone');

        if($warehouse->save()){
            if( $warehouse->address->save() ){
                return redirect(route('admin.warehouses.index'));
            }
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

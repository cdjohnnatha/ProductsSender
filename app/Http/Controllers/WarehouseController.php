<?php

namespace App\Http\Controllers;

use App\Address;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('listAll');
    }

    public function create()
    {
        return view('warehouse.form');
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

    public function showList()
    {
        return view('warehouse.list');
    }

    public function listAll()
    {
        return response()->json([
            'warehouses' => Warehouse::with('address')->get(),
        ])->setStatusCode(200);
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->address;
        return response()->json([
            'warehouse' => $warehouse
        ]);
    }

    public function edit()
    {
        return view('warehouse.form');
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->address;
        $warehouse->name = $request->input('name');
        $warehouse->storage_time = $request->input('storage_time');
        $warehouse->box_price = $request->input('box_price');
        $warehouse->updated_by = Auth::user()->id;
        $warehouse->created_by = Auth::user()->id;


        $warehouse->address->label = $request->input('address.label');
        $warehouse->address->owner_name = $request->input('address.owner_name');
        $warehouse->address->owner_surname = $request->input('address.owner_surname');
        $warehouse->address->company_name = $request->input('address.company');

        if(is_null($warehouse->address->company_name))
            $warehouse->address->company_name = '';
        $warehouse->address->country = $request->input('address.country');
        $warehouse->address->address = $request->input('address.address');
        $warehouse->address->city = $request->input('address.city');
        $warehouse->address->state = $request->input('address.state');
        $warehouse->address->postal_code = $request->input('address.postal_code');
        $warehouse->address->phone = ''.$request->input('address.phone');
        $warehouse->address->default_address = true;

        if($warehouse->save()){
            if( $warehouse->address->save() ){
                return response('/admin/warehouses/show-list', 201);
            }
        }

        return response()->setStatusCode(406);
    }

    public function destroy($id)
    {
        $user = Warehouse::findOrFail($id);
        $user->delete();
        return response('admin/warehouses/show-list', 201);

    }
}

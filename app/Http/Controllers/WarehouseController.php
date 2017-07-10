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
        $this->middleware(['auth:admin', 'auth']);
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function register(Request $request)
    {   $warehouse = new Warehouse();
        $warehouse->name = $request->input('nameWarehouse');
        $warehouse->storage_time = $request->input('storageTime');
        $warehouse->box_price = $request->input('boxPrice');
        $warehouse->updated_by = Auth::user()->id;
        $warehouse->created_by = Auth::user()->id;

        $address = new Address();
        $address->label = $request->input('address.addressLabel');
        $address->owner_name = $request->input('address.owner_name');
        $address->owner_surname = $request->input('address.owner_surname');
        $address->company_name = $request->input('address.company');

        if(is_null($address->company_name))
            $address->company_name = '';
        $address->country = $request->input('address.country');
        $address->address = $request->input('address.address');
        $address->city = $request->input('address.city');
        $address->state = $request->input('address.state');
        $address->postal_code = $request->input('address.postalCode');
        $address->phone = ''.$request->input('address.phone');
        $address->default_address = true;

        if($warehouse->save()){
            if( $warehouse->address()->save($address) ){
                return response('/admin/warehouses/show-list', 201);
            }
        }
        return $warehouse;
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
        return response()->json([
            'warehouses' => Warehouse::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request->input('name');
        $warehouse->storage_time = $request->input('storage_time');
        $warehouse->box_price = $request->input('box_price');
        $warehouse->updated_by = $request->input('updated_by');
        $warehouse->address_id = $request->input('address_id');

        if($warehouse->save()){
//            return response()->json([
//                'user' => $user
//            ])->setStatusCode(201);
            return redirect('home/all')->setStatusCode(200);
        }

        return response()->setStatusCode(406);
    }

    public function destroy($id)
    {
        $user = Warehouse::findOrFail($id);
        $user->delete();
        return redirect('home/all')->setStatusCode(201);

    }
}
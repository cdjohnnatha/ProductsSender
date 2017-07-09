<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auth']);
    }


    public function listAll()
    {
        return response()->json([
            'warehouses' => Warehouse::paginate(15),
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

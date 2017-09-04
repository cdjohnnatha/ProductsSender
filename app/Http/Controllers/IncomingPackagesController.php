<?php

namespace App\Http\Controllers;

use App\IncomingPackages;
use App\OfferedService;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Browser\OfferedServicesTest;

class IncomingPackagesController extends Controller
{

    public function rules()
    {
        return [
          'incoming.provider' => 'nullable',
          'incoming.addressee' => 'required',
          'incoming.track_number' => 'required|string',
          'incoming.note' => 'nullable',
          'warehouse_id' => 'required',
          'custom_clearance' => 'required|array|min:1',
          'custom_clearance.*.description' => 'required|string',
          'custom_clearance.*.quantity' => 'required|integer',
          'custom_clearance.*.unit_price' => 'required',
          'custom_clearance.*.total_unit' => 'required',

        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $services = OfferedService::all();
        return view('package.incoming.create', compact('warehouses', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $incoming = new IncomingPackages($request->input('incoming'));
        $incoming->warehouse_id = $request->input('warehouse_id');
        $incoming->total_goods = $request->input('total_goods');
        if($incoming->save()){
            $incoming->goodsDeclaration()->createMany($request->input('custom_clearance'));
            $incoming->additionalService()->createMany($request->input('additional_service'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

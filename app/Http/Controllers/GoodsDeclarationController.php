<?php

namespace App\Http\Controllers;

use App\GoodsDeclaration;
use App\IncomingPackages;
use App\Package;
use Illuminate\Http\Request;

class GoodsDeclarationController extends Controller
{


    public function rules()
    {
        return [
            'goods.provider' => 'required',
            'goods.content_type' => 'required',
            'goods.description' => 'required|string',
            'custom_clearance' => 'required|array|min:1',
            'custom_clearance.*.description' => 'required|string',
            'custom_clearance.*.quantity' => 'required|integer',
            'custom_clearance.*.unit_price' => 'required',
            'custom_clearance.*.total_unit' => 'required',

        ];
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $package_id = $id;
        return view('package.goods.create', compact('package_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, $this->rules());

        $goods = new IncomingPackages($request->input('goods'));
        $package = Package::find($id);
        $goods->registered = true;
        $goods->total_goods = $request->input('total_goods');
        $goods->warehouse_id = $package->warehouse->id;
        $goods->track_number = null;
        $goods->total_addons = 0.00;
        $goods->user_id = $package->object_owner;
        $goods->package_id = $id;
        $goods->track_number = '';
        $goods->addressee = $package->user->name;

        if($goods->save()) {
            $goods->goodsDeclaration()->createMany($request->input('custom_clearance'));
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
        $goods = GoodsDeclaration::find($id);
        $goods->delete();

        if($goods->trashed()){
            return back();
        }
    }
}

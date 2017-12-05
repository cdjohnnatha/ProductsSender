<?php

namespace App\Http\Controllers;

use App\PackageGoodsDeclaration;
use App\IncomingPackages;
use App\Package;
use Illuminate\Http\Request;

class GoodsDeclarationController extends Controller
{
    public function index(){

    }

    public function create($id){
        $package_id = $id;
        return view('package.goods.create', compact('package_id'));
    }

    public function store(Request $request, $id){
        $this->validate($request, [
            'goods.provider' => 'required',
            'goods.content_type' => 'required',
            'goods.description' => 'required|string',
            'custom_clearance' => 'required|array|min:1',
            'custom_clearance.*.description' => 'required|string',
            'custom_clearance.*.quantity' => 'required|integer',
            'custom_clearance.*.unit_price' => 'required',
            'custom_clearance.*.total_unit' => 'required',

        ]);

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

    public function destroy($id){
        PackageGoodsDeclaration::find($id)->delete();

        return back();
    }
}

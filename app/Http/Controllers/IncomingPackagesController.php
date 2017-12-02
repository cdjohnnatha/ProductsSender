<?php

namespace App\Http\Controllers;

use App\IncomingPackages;
use App\Notifications\IncomingPackageNotification;
use App\Service;
use App\CompanyWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomingPackagesController extends Controller
{
    private $pagePrefix;

    public function __construct(){
        $this->pagePrefix = 'package.incoming.';
    }

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

    public function index(){
        if (auth()->guard('web')->user()) {
            $incomingPackages = IncomingPackages::where('registered', false)
                ->where('user_id', Auth::user()->id)->get();
        } else {
            $incomingPackages = IncomingPackages::where('registered', false)
                ->where('warehouse_id', Auth::user()->warehouse_id)->get();
        }

        return view($this->pagePrefix.'index', compact('incomingPackages'));
    }

    public function create(){
        $warehouses = CompanyWarehouse::all();
        $services = Service::all();
        return view($this->pagePrefix.'create', compact('warehouses', 'services'));
    }

    public function store(Request $request){
        $this->validate($request, $this->rules());
        $incoming = new IncomingPackages($request->input('incoming'));
        $incoming->warehouse_id = $request->input('warehouse_id');
        $incoming->total_goods = $request->input('total_goods');
        $incoming->total_addons = $request->input('total_addons');
        $incoming->user_id = Auth::user()->id;
        if ($incoming->save()) {
            $incoming->goodsDeclaration()->createMany($request->input('custom_clearance'));
            $incoming->addons()->createMany($request->input('additional_service'));
            CompanyWarehouse::find($incoming->warehouse_id)->notify(new IncomingPackageNotification($incoming));
            $request->session()->flash('info', __('statusMessage.incoming_package.user_create'));
            return redirect(route('user.packages.index'));
        }
    }

    public function show($id){
        $incomingPackage = IncomingPackages::with('addons')->find($id);
        return view($this->pagePrefix.'show', compact('incomingPackage'));
    }

    public function edit($id){
        $incoming = IncomingPackages::with('goodsDeclaration')->find($id);
        $warehouses = CompanyWarehouse::all();
        $services = Service::all();
        return view($this->pagePrefix.'create', compact('incoming', 'warehouses', 'services'));
    }

    public function update(Request $request, $id){
        $this->validate($request, $this->rules());
        $incoming = IncomingPackages::find($id);

        foreach ($request->input('custom_clearance') as $goods) {
            if (isset($goods['id'])) {
                $incoming->goodsDeclaration()->updateOrCreate(
                    ['id' => $goods['id']],
                    $goods
                );
            } else {
                $incoming->goodsDeclaration()->create($goods);
            }
        }
        $incoming->fill($request->input('incoming'));
        if ($incoming->save()){
            if(auth()->guard('web')->user()){
                $userType = 'user';
            } else {
                $userType = 'admin';
            }

            $request->session()->flash('info',
                __('statusMessage.global_message.entity.updated', [
                    ':entity' => __('common.titles.incoming_package')
                ]));

            return redirect(route($userType.'.packages.index'));
        }

    }

    public function destroy($id){
        $incomingPackage = IncomingPackages::find($id);
        $incomingPackage->delete();

        if ($incomingPackage->trashed()) {
            if(auth()->guard('web')->user()){
                $userType = 'user';
            } else {
                $userType = 'admin';
            }
            return redirect(route($userType.'.incoming.index'));
        }
    }
}

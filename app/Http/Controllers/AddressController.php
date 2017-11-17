<?php

namespace App\Http\Controllers;

use App\Address;
use App\AddressGeonameCode;
use App\Admin;
use App\User;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    // TODO: a mesma rule pra create e update? nem sempre...
    public function rules()
    {
        return [
            'address.label' => 'bail|required|min:3',
            'address.owner_name' => 'required',
            'address.owner_surname' => 'required',
            'address.phone' => 'required',
            'address.company_name' => 'nullable',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.country' => 'required',
            'address.street' => 'required|min:3',
            'address.street2' => 'nullable|string',
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'geonames.country' => 'required',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
        ];
    }

    public function index(Request $request, $id = null)
    {
        if(is_null($id)) {
            $id = Auth::user()->id;
        }
        $morph = $this->getClass($request)::with('address')->findOrFail($id);
        $warehouses = Warehouse::with('address')->get();
        return  view('address.index', compact('morph', 'warehouses'));
    }

    public function create()
    {
        return view('address.create');
    }

    //TODO: tudo errado nesse polymorph
    // tem que separar TUDO mesmo (User / Admin / Warehouse)
    public function store(Request $request, $id = null){
        if(is_null($id)){
            $id = Auth::user()->id;
        }
        $this->validate($request, $this->rules());
        $polymorph = $this->getClass($request);
        $address = new Address($request->input('address'));
        $object = $polymorph::find($id);
        if($object->address()->save($address)){
            $request->session()->flash('success',
                __('statusMessage.global_message.attribute.created', [
                    'attribute' => $address->label,
                    'entity' => __('common.titles.address')]));
            return redirect(route($this->getType($request).'.address.index'));
        }
    }

    public function show($id, $address_id=null)
    {
        $address = Address::findOrFail($address_id);
        return $address_id;
    }

    public function edit($id)
    {
        $address = Address::with('geonames')->findOrFail($id);
        return view('address.create', compact('address'));
    }

    public function update(Request $request, $id = null){
        $this->validate($request, $this->rules());

        $address = Address::with('geonames')->findOrFail($id);
        $address->fill($request->input('address'));

        $request->session()->flash('success',
            __('statusMessage.global_message.entity.updated', [
                'attribute' => $address->label,
                'entity' => __('common.titles.address')]));

        if(is_null($address->geonames)) {
            $geonames = new AddressGeonameCode($request->input('geonames'));
            if($address->save() && $address->geonames()->save($geonames)){
                return redirect(Route('user.address.index'));
            }

        } else {
            $address->geonames->fill($request->input('geonames'));
            if($address->save() && $address->geonames->save()){
                return redirect(Route('user.address.index'));
            }
        }
    }

    public function destroy(Request $request, $id){
        $address = Address::findOrFail($id);
        $address->delete();
        if($address->trashed()){
            $request->session()->flash('info',
                __('statusMessage.status.address.create', [
                    'attribute' => $address->label,
                    'entity' => __('common.titles.address')]));

            return redirect(route($this->getType($request).'.address.index'));
        }
    }

    public function defaultAddress(Request $request, $id){
        $user = User::find(Auth::user()->id);
        $user->default_address = $id;
        if ($user->save()) {
            return redirect(Route('user.address.index'));
        }

    }

    private function getClass($request){
        if ($request->is('warehouse/*')) {
            return Warehouse::class;
        }else if($request->is('user/*')) {
            return User::class;
        } else{
            return Admin::class;
        }
    }

    private function getType($request){
        if ($request->is('warehouse/*')) {
            return 'warehouse';
        }else if($request->is('user/*')) {
            return 'user';
        } else{
            return 'admin';
        }
    }
}

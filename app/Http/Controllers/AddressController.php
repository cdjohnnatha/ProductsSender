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
            'address.number' => 'required|string|max:15',
            'address.formatted_address' => 'required',
            'address.postal_code' => 'required',
            'geonames.country' => 'required',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        if(is_null($id)){
            $id = Auth::user()->id;
        }
        $morph = $this->getClass($request)::with('address')->findOrFail($id);
        $warehouses = Warehouse::with('address')->get();
        return  view('address.index', compact('morph', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
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
            return redirect($this->getType($request).'address.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $address_id=null)
    {
        $address = Address::findOrFail($address_id);
        return $address_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::with('geonames')->findOrFail($id);
        return view('address.create', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
//        dd($request->input());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        if($address->thashed()){
            $request->session()->flash('info',
                __('statusMessage.status.address.create', [
                    'attribute' => $address->label,
                    'entity' => __('common.titles.address')]));

            return redirect(Route($this->getType($request).'.address.index'));
        }
    }

    public function defaultAddress(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $user->default_address = $id;
        if ($user->save()) {
            return redirect(Route('user.address.index'));
        }

    }

    private function getClass($request)
    {
        if ($request->is('warehouse/*')) {
            return Warehouse::class;
        }else if($request->is('user/*')) {
            return User::class;
        } else{
            return Admin::class;
        }
    }

    private function getType($request)
    {
        if ($request->is('warehouse/*')) {
            return 'warehouse';
        }else if($request->is('user/*')) {
            return 'user';
        } else{
            return 'admin';
        }
    }
}

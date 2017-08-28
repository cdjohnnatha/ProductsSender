<?php

namespace App\Http\Controllers;

use App\Address;
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
            'address.default_address' => 'boolean',
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
        $disabled_default = $this->getClass($request)::with([
            'address' => function($query){
                $query->where('default_address', true);
            }])->findOrFail($id)->count();

        return  view('address.index', compact('morph', 'disabled_default'));
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
            return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null , $address_id = null)
    {
        $this->validate($request, $this->rules());

        if(is_null($address_id)){
            $address = Address::findOrFail($id);
        }
        else{
            $address = Address::findOrFail($address_id);
        }
        $address->label = $request->input('label');
        $address->owner_name = $request->input('owner_name');
        $address->owner_surname = $request->input('owner_surname');
        $address->company_name = $request->input('company_name');
        $address->country = $request->input('country');
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->postal_code = $request->input('postal_code');
        $address->phone = $request->input('phone');

        if($address->save()){
            return response('', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        if($address->thashed()){
            return response('', 200);
        }
    }

    public function defaultAddress(Request $request, $id)
    {
        $previous_default = $this->getClass($request)::with([
            'address' => function ($query) {
                $query->where('default_address', true);
            }])->findOrFail(Auth::user()->id)->address[0];
        $previous_default->default_address = false;
        $address = Address::findOrFail($id);
        $address->default_address = true;
        if ($previous_default->save() && $address->save()) {
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

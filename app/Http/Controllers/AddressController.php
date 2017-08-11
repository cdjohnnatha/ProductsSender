<?php

namespace App\Http\Controllers;

use App\Address;
use App\Admin;
use App\User;
use App\Warehouse;
use Illuminate\Http\Request;

class AddressController extends Controller
{


    public function rules()
    {
        return [
            'address.label' => 'bail|required|min:3',
            'address.owner_name' => 'required',
            'address.owner_surname' => 'required',
            'address.country' => 'required',
            'address.address' => 'required|min:5',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.postal_code' => 'required',
            'address.phone' => 'required|numeric',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $morph = $this->getClass($request)::with('address')->findOrFail($id);
        $default = $this->getClass($request)::with([
            'address' => function($query){
                $query->where('default_address', true);
            }])->findOrFail($id);
        return  view('address.index', compact('morph', 'default'));
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
    public function store(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $polymorph = $this->getClass($request->route()->getPrefix());
        $address = new Address($request->all());
        $object = $polymorph::find($id);
        if($object->address()->save($address)){
            return redirect()->action('AddressController@index', $id);
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

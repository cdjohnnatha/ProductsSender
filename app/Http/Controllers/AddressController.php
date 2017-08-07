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
            'label' => 'bail|required|min:3',
            'owner_name' => 'required',
            'owner_surname' => 'required',
            'country' => 'required',
            'address' => 'required|min:5',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return  $id;
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
//        if($object->address()->save($address)){
            return redirect()->action('AddressController@index', $id);
//        }

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

    private function getClass($urlPrefix)
    {
        if( strpos( $urlPrefix, 'warehouse' ) !== false ) {
            return Warehouse::class;
        }else if(strpos( $urlPrefix, 'user' ) !== false) {
            return User::class;
        } else{
            return Admin::class;
        }
    }
}

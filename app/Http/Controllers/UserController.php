<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auth']);
    }

    public function viewUsers()
    {
        return view('user.all');
    }

    public function users()
    {
        $users = User::with('subscription')->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'user' => User::findOrFail($id)
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();
        $address = new Address;
        $user->name = $request->input('user.name');
        $user->surname = $request->input('user.surname');
        $user->country = $request->input('user.country');
        $user->email = $request->input('user.email');
        $user->subscriptions_id = (int) $request->input('user.subscriptions');
        $user->phone = ''.$request->input('user.phone');
        $user->password = bcrypt($request->input('user.password'));

        $address->label = $request->input('user.address.addressLabel');
        $address->owner_name = $request->input('user.address.owner_name');
        $address->owner_surname = $request->input('user.address.owner_surname');
        $address->company_name = $request->input('user.address.company');

        if(is_null($address->company_name))
            $address->company_name = '';
        $address->country = $request->input('user.address.country');
        $address->address = $request->input('user.address.address');
        $address->city = $request->input('user.address.city');
        $address->state = $request->input('user.address.state');
        $address->postal_code = $request->input('user.address.postalCode');
        $address->phone = ''.$request->input('user.address.phone');
        $address->default_address = true;
        $user = User::find(13);

        if($user->save()){
            if( $user->address()->save($address) ){
                return response('created', 201);
            }
        }

        return response('bad request',400);

    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        if(!empty($request->input('plan')) || $request->input('plan') != '')
            $user->subscriptions_id = (int) $request->input('plan');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');

        if($user->save()){
            if(auth()->guard('admin')->user()){
                return redirect('admin/users');
            }else {
                return redirect('home/'.$id);
            }
        }

        return response()->setStatusCode(406);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if(auth()->guard('admin')->user()){
            return response('/admin/users', 200);
        }else {
            return redirect('/');
        }
    }
}

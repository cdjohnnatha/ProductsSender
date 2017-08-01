<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\User;
use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = '/user';

    protected function redirectTo()
    {

        return '/user/'.Auth::user()->id;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|string',
            'subscription_id' => 'required',
            'phone' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    public function registerForm()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $user = new User();
        $address = new Address;
        $user->name = $request->input('user.name');
        $user->surname = $request->input('user.surname');
        $user->country = $request->input('user.country');
        $user->email = $request->input('user.email');
        $user->subscription_id = (int) $request->input('user.subscription_id');
        $user->phone = ''.$request->input('user.phone');
        $user->password = bcrypt($request->input('user.password'));

        $address->label = $request->input('user.address.label');
        $address->owner_name = $request->input('user.address.owner_name');
        $address->owner_surname = $request->input('user.address.owner_surname');
        $address->company_name = $request->input('user.address.company');
        if(is_null($address->company_name))
            $address->company_name = '';
        $address->country = $request->input('user.address.country');
        $address->address = $request->input('user.address.address');
        $address->city = $request->input('user.address.city');
        $address->state = $request->input('user.address.state');
        $address->postal_code = $request->input('user.address.postal_code');
        $address->phone = ''.$request->input('user.address.phone');
        $address->default_address = true;

        if($user->save()){
            if( $user->address()->save($address) && $user->wallet()->save(new Wallet())){
                return response('created', 201);
            }

        }

        return response('bad request',400);

    }
}

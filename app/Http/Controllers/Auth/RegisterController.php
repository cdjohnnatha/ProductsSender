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

        return '/user/'.Auth::user()->id.'/dashboard';
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

    public function rules()
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user.country' => 'required|string',
            'subscription_id' => 'required',
            'user.phone' => 'required|string',
            'user.password' => 'required|string|min:6|confirmed',
            'label' => 'required',
            'owner_name' => 'required',
            'owner_surname' => 'required',
            'company' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'phone' => 'required|string',
            'country' => 'required|string',
        ];
    }


    public function registerForm()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
//        dd($request->input());
        dd($this->validate($request, $this->rules()));
        $user = new User();
        $address = new Address;
        $user->name = $request->input('user.name');
        $user->surname = $request->input('user.surname');
        $user->country = $request->input('user.country');
        $user->email = $request->input('email');
        $user->subscription_id = (int) $request->input('subscription_id');
        $user->phone = ''.$request->input('user.phone');
        $user->password = bcrypt($request->input('user.password'));

        $address->label = $request->input('label');
        $address->owner_name = $request->input('owner_name');
        $address->owner_surname = $request->input('owner_surname');
        $address->company_name = $request->input('company');
        if(is_null($address->company_name))
            $address->company_name = '';
        $address->country = $request->input('country');
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->postal_code = $request->input('postal_code');
        $address->phone = ''.$request->input('phone');
        $address->default_address = true;

        if($user->save()){
            if( $user->address()->save($address) && $user->wallet()->save(new Wallet())){
                return redirect(route('users.index'));
            }

        }

    }
}

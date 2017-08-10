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

        return route('user.dashboard', Auth::user()->id);
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
            'users.name' => 'required|string|max:255',
            'users.surname' => 'required|string|max:255',
            'users.email' => 'required|string|email|max:255|unique:users',
            'users.country' => 'required|string',
            'users.subscription_id' => 'required|integer',
            'users.phone' => 'required|string',
            'users.password' => 'required|string|min:6|confirmed',
            'address.label' => 'required',
            'address.owner_name' => 'required',
            'address.owner_surname' => 'required|string',
            'address.company_name' => 'nullable|string',
            'address.address' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.postal_code' => 'required',
            'address.phone' => 'required|string',
            'address.country' => 'required|string',
        ];
    }


    public function registerForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $user = new User($request->input('users'));
        $address = new Address($request->input('address'));
        $user->subscription_id = (int)$request->input('users.subscription_id');
        $user->password = bcrypt($request->input('users.password'));
        $address->default_address = true;

        if($user->save()){
            if( $user->address()->save($address) && $user->wallet()->save(new Wallet())){
                return redirect(route('user.dashboard', $user->id));
            }

        }

    }
}

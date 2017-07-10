<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\User;
use App\Http\Controllers\Controller;
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'phone' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        return User::create([
//            'name' => $data['name'],
//            'surname' => $data['name'],
//            'email' => $data['email'],
//            'country' => $data['country'],
//            'plan' => $data['plan'],
//            'phone' => $data['phone'],
//            'password' => bcrypt($data['password']),
//        ]);
    }
    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->plan = 'none';
        $user->password = bcrypt($request->input('password'));
        session(['user' => $user]);
//        $user->save();
        return redirect('register/address')->with($user);
    }

    public function addressForm()
    {
        return view('address.create');
    }

    public function registerAddress(Request $request)
    {
        $address = new Address();
        $address->label = $request->input('label-address');
        $address->owner_name = $request->input('owner-name');
        $address->owner_surname = $request->input('owner-surname');
        $address->company_name = $request->input('company-name');
        $address->country = $request->input('country');
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->postal_code = $request->input('postal-code');
        $address->phone = $request->input('phone');
        $address->user_type = 'user';
        $address->default_address = true;
        $user = User::where('email', session('email'))->first();
        $address->user_id = $user->id;
//        $address->save();
        return redirect('register/plan');
    }

    public function showPlans()
    {
        return view('vendor.prices.prices');
    }

    public function registerAccount(Request $request)
    {
        $user = User::where('email', session('user')->email)->first();
        $user->plan = $request->input('plan');
        $user->save();

        return redirect('/');

    }
}

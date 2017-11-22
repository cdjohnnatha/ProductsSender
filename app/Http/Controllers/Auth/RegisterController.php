<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\ClientAddressGeoname;
use App\Mail\UserRegisterConfirmation;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\CompanySubscription;
use App\User;
use App\Http\Controllers\Controller;
use App\ClientWallet;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    private $user;

    protected function redirectTo()
    {
        return route('user.dashboard');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('guest');
        $this->user = $user;

    }

    public function rules()
    {
        return [
            'user.email' => 'required|string|email|max:255|unique:users,email',
            'user.password' => 'required|string|min:6|confirmed',
            'client.name' => 'required|string|max:255',
            'client.surname' => 'required|string|max:255',
            'client.rg' => 'required|string',
            'client.cpf' => 'required|string',
            'client.phone' => 'required|string',
            'address.label' => 'required',
            'address.owner_name' => 'required',
            'address.owner_surname' => 'required|string',
            'address.company_name' => 'nullable|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.postal_code' => 'required',
            'address.phone' => 'required|string',
            'address.country' => 'required|string',
            'address.street' => 'required|string',
            'address.formatted_address' => 'required|string',
            'identification_card' => 'required|image',
            'usps_form' => 'required|image',
            'proof_address' => 'required|file',
        ];
    }


    public function register()
    {


        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        if($this->user->store($request)) {
            $request->session()->flash('info', __('email_verification.registered_message'));
            return redirect()->route('login');
        }
        return back();
    }

    public function confirm(Request $request, $confirmation_code)
    {
        if($this->user->confirmeAccount($confirmation_code)){
            $request->session()->flash('success', __('statusMessage.global_message.entity.confirmed', ['entity' => __('common.titles.account')]));
            return redirect(route('login'));
        } else {
            $request->session()->flash('error',
                __('statusMessage.global_message.attribute.updated', ['entity' => 'Account Confirmation']));
            return redirect('/');
        }
    }

}

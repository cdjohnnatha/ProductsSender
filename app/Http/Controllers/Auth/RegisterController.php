<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\AddressGeonameCode;
use App\Mail\UserRegisterConfirmation;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Subscription;
use App\User;
use App\Http\Controllers\Controller;
use App\Wallet;
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
    private $subscriptions;
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
    public function __construct(UserRepository $user, SubscriptionRepository $subscription)
    {
        $this->middleware('guest');
        $this->subscriptions = $subscription;
        $this->user = $user;

    }

    public function rules()
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.surname' => 'required|string|max:255',
            'user.rg' => 'required|string',
            'user.cpf' => 'required|string',
            'user.email' => 'required|string|email|max:255|unique:users,email',
            'user.phone' => 'required|string',
            'user.subscription_id' => 'required',
            'user.password' => 'required|string|min:6|confirmed',
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
            'geonames.country' => 'required',
            'geonames.city' => 'required',
            'geonames.state' => 'required',
        ];
    }


    public function register()
    {
        $subscriptions_active_month = $this->subscriptions->getPerTimeWithBenefits('amount', 1, true, 3);
        $subscriptions_active_year = $this->subscriptions->getPerTimeWithBenefits('amount', 12, true, 3);

        return view('auth.register', compact('subscriptions_active_month','subscriptions_active_year'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        if($this->user->store($request)) {
            $request->session()->flash('info', __('email_verification.registered_message'));
            return redirect('/');
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

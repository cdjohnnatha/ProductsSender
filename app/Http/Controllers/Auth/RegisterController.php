<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\AddressGeonameCode;
use App\Mail\UserRegisterConfirmation;
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

    protected function redirectTo()
    {
        return route('user.dashboard');
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
            'user.rg' => 'required|string',
            'user.cpf' => 'required|string',
            'user.email' => 'required|string|email|max:255|unique:users,email',
            'user.phone' => 'required|string',
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
            'register.subscription_id' => 'required',
        ];
    }


    public function register()
    {
        $subscriptions_active_month = Subscription::with('benefits')
                                    ->where('active',  1)
                                    ->where('period', 0)
                                    ->orderBy('amount')
                                    ->limit(3)
                                    ->get();

        $subscriptions_active_year = Subscription::with('benefits')
            ->where('active',  1)
            ->where('period', 1)
            ->limit(3)
            ->orderBy('amount')
            ->get();


        return view('auth.register',
            compact('subscriptions_active_month',
                    'subscriptions_active_year'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $user = new User($request->input('user'));
        $user->subscription_id = $request->input('register.subscription_id');
        $user->country = $request->input('address.country');
        $address = new Address($request->input('address'));
        $geonames = new AddressGeonameCode($request->input('geonames'));
        $user->password = bcrypt($request->input('users.password'));
        $user->confirmation_code = base64_encode($user->email);
        Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
        if($user->save() && $user->address()->save($address) && $user->wallet()->save(new Wallet())
            && $user->address[0]->geonames()->save($geonames)) {
            $user->default_address = $user->address[0]->id;
            if($user->save()) {
                $request->session()->flash('info', __('email_verification.registered_message'));
//                Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
                return redirect('/');
            }

        }
        return back();
    }

    public function confirm(Request $request, $confirmation_code)
    {

        if(!$confirmation_code){
            $request->session()->flash('error',
                __('statusMessage.global_message.attribute.updated', ['entity' => 'Account Confirmation']));
            return redirect('/');
        }
        $user = User::where('confirmation_code', $confirmation_code)->first();

        if($user){
            if($user->confirmed){
                $request->session()->flash('warning', __('statusMessage.account', ['entity' => __('common.titles.account')]));
                return redirect(route('login'));
            }
            $user->confirmed = true;
            $user->save();
            $request->session()->flash('success', __('statusMessage.global_message.entity.confirmed', ['entity' => __('common.titles.account')]));
            return redirect(route('login'));
        }

        return redirect(route('login'));
    }

}

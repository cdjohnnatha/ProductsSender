<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $users = User::with('subscription')->get();

        return view('user.index', compact('users'));
    }

    public function dashboard(){
        return view('home');
    }

    public function create(){
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

        if(auth()->guard('admin')->user()){
            $subscriptions= Subscription::with('benefits')
                ->where('active',  1)
                ->orderBy('amount')
                ->get();

            return view('auth.register', compact('user', 'subscriptions'));
        }


        return view('auth.register',
            compact('subscriptions_active_month',
                'subscriptions_active_year'));
    }

    public function show($id){
        $user = User::with([
            'subscription',
            'address' => function($query){
                $query->where('default_address', true);
            }])->findOrFail($id);
        return view('user.perfil', compact('user'));
    }

    public function edit($id){
        $user = User::find($id);

        if(auth()->guard('admin')->user()){
            $subscriptions= Subscription::with('benefits')
                ->where('active',  1)
                ->orderBy('amount')
                ->get();

            return view('user.edit', compact('user', 'subscriptions'));
        }
        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'user.name' => 'bail|required|min:3',
            'user.surname' => 'required|string',
            'user.rg' => 'required',
            'user.cpf' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'user.phone' => 'required|numeric',
            'user.password' => 'nullable|confirmed',
            'register.subscription_id' => 'required',
        ]);
        $user = User::findOrFail($id);
        if(is_null($request->password)){
            $tmp = $request->except('user.password');
            $user->fill($tmp['user']);
        } else{
            $user->fill($request->input('user'));
        }


        if($user->save()){
            if(auth()->guard('admin')->user()){
                return redirect(route('admin.users.index'));
            }else {
                return redirect(route('user.dashboard', $user->id));
            }
        }
    }

    public function destroy($id){
        User::findOrFail($id)->delete();

        if(auth()->guard('admin')->user()){
            return response('/admin/users', 200);
        } else {
            return redirect('/');
        }
    }
}

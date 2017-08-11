<?php

namespace App\Http\Controllers;

use App\Address;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    private function rules()
    {
        return [
            'users.name' => 'required|string',
            'users.surname' => 'required|string',
            'users.email' => 'required|email|string',
            'users.password' => 'nullable|confirmed',
            'users.subscription_id' => 'required'
        ];
    }

    public function index()
    {
        $users = User::with('subscription')->get();
        return view('user.index', compact('users'));
    }

    public function dashboard()
    {
        return view('home');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function show($id)
    {
        $user = User::with([
            'subscription',
            'address' => function($query){
                $query->where('default_address', true);
            }])->findOrFail($id);
        return view('user.perfil', compact('user'));
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'users.name' => 'bail|required|min:3',
            'users.surname' => 'required|string',
            'users.email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'users.phone' => 'required|numeric',
            'users.country' => 'required',
            'users.password' => 'nullable|confirmed',
            'users.subscription_id' => 'required',
        ]);
        $user = User::findOrFail($id);
        if(is_null($request->password)){
            $tmp = $request->except('users.password');
            $user->fill($tmp['users']);
        } else{
            $user->fill($request->input('users'));
        }


        if($user->save()){
            if(auth()->guard('admin')->user()){
                return redirect(route('admin.users.index'));
            }else {
                return redirect(route('user.dashboard', $user->id));
            }
        }
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

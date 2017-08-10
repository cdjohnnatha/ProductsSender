<?php

namespace App\Http\Controllers;

use App\Address;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json(['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $user = User::findOrFail($id);
        $user->name = $request->input('users.name');
        $user->surname = $request->input('users.surname');
        $user->email = $request->input('users.email');
        $user->subscription_id = (int) $request->input('users.subscription_id');
        $user->country = $request->input('users.country');
        $user->phone = $request->input('users.phone');
        if(!empty($request->input('users.password')))
            $user->password = bcrypt($request->input('users.password'));

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

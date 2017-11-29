<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $user;
    private $subscriptions;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('user.index', compact('users'));
    }

    public function dashboard()
    {
        return view('home');
    }

    public function create()
    {
        if(auth()->guard('admin')->user()){
            $subscriptions = $this->subscriptions->getAllActive();
            return view('auth.register', compact('user', 'subscriptions'));
        }


        return view('auth.register');
    }

    public function show($id){

    }

    public function edit($id)
    {
        $user = $this->user->findById($id);

        if(auth()->guard('admin')->user()) {
            $subscriptions = $this->subscriptions->getAllActive();
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
        $user = $this->user->findById($id);

        if(is_null($request->password)){
            $user->fill($request->except('user.password'));
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

    public function destroy($id)
    {
        $this->user->destroy($id);

        if(auth()->guard('admin')->user()){
            return response('/admin/users', 200);
        } else {
            return redirect('/');
        }
    }
}

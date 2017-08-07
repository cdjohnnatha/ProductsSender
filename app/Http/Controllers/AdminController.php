<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function rules()
    {
        return [
            'name' => 'bail|required|min:3',
            'surname' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'country' => 'required',
            'default_warehouse_id' => 'required',
            'password' => 'required|string|min:6|confirmed'

        ];
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->country = $request->input('country');
        $admin->default_warehouse_id = $request->input('default_warehouse_id');
        $admin->password = bcrypt($request->input('password'));

        if( $admin->save() ){
            return redirect(route('admin.index'))->setStatusCode(200);
        }
    }

    public function show($id)
    {
        return response()->json([
            'admin' => Admin::findOrFail($id)
        ]);
    }

    public function edit($id){
        $admin = Admin::find($id);
        return view('admin.create', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->email = $request->input('email');
        $admin->country = $request->input('country');

        if($admin->save()){
            return redirect(route('admin.index'))->setStatusCode(200);
        }

    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        if ($admin->trashed()) {
            return redirect(route('admin.index'))->setStatusCode(200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    private function rules()
    {
        return [
            'name' => 'bail|required|min:3',
            'surname' => 'required',
            'email' => 'required|string|email|max:255|unique:admins',
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
        $admin = new Admin($request->all());
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
        $this->validate($request,[
            'name' => 'bail|required|min:3',
            'surname' => 'required',
            'email' => [
                'required',
                Rule::unique('admins')->ignore($id),
            ],
            'phone' => 'required|numeric',
            'country' => 'required',
            'default_warehouse_id' => 'required',
            'password' => 'nullable|confirmed'
        ]);
        $admin = Admin::findOrFail($id);
        if(is_null($request->password)){
            $admin->fill($request->except('password'));
        } else{
            $admin->fill($request->all());
        }

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

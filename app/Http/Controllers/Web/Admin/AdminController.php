<?php

namespace App\Http\Controllers\Web\Admin;

use App\Admin;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    private $adminRepository;

    public function __construct(AdminRepository $model)
    {
        $this->adminRepository = $model;
    }

    public function index()
    {
        $admins = $this->adminRepository->getAll();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        $warehouses = CompanyWarehouse::with('address')->get();
        return view('admin.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $this->adminRepository->store($request);
        $request->session()->flash('success', 'Admin was successfully created!');
        return redirect(route('admin.index'));
    }

    public function edit($id){
        $data['admin'] = $this->adminRepository->findById($id);
        return view('admin.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|confirmed'
        ]);


        $this->adminRepository->update($id, $request);

        $request->session()->flash('success', 'Admin was successfully updated!');
        return redirect(route('admin.index'))->setStatusCode(200);

    }

    public function destroy($id)
    {

        $this->adminRepository->destroy($id);
        return redirect(route('admin.index'))->setStatusCode(200);
    }
}

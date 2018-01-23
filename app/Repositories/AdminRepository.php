<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 4:41 PM
 */

namespace App\Repositories;

use App\Entities\Admin\Admin;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Foundation\Auth\User;

class AdminRepository implements RepositoryInterface
{

    private $model;
    private $user;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('user')->get();

    }

    public function store($request)
    {
        $admin = new $this->model($request->all());
        $admin->password = bcrypt($request->input('password'));
        if($admin->save()) {
            return true;
        } else {
            return false;
        }

    }

    public function update($id, $request)
    {
        $admin = $this->model::findOrFail($id);

        if(is_null($request->password)){
            $admin->update($request->except('password'));
        } else {
            $admin->update($request->all());
        }

    }

    public function findById($attribute)
    {
        return $this->model::find($attribute);
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
    }
}
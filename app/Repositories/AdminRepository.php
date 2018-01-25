<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 4:41 PM
 */

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
class AdminRepository implements RepositoryInterface
{

    private $model;

    public function __construct(UserRepository $userRepository)
    {
        $this->model = $userRepository;
    }

    public function getAll()
    {
        return $this->model->getAllByType('admin');

    }

    public function store($request)
    {
        return $this->model->storeUserTypes($request, 'admin');

    }

    public function update($id, $request)
    {
        $admin = $this->model->findById($id);

        if(is_null($request->password)){
            $admin->update($request->except('password'));
        } else {
            $admin->update($request->all());
        }

    }

    public function findById($attribute)
    {
        return $this->model->findById($attribute);
    }

    public function destroy($id)
    {
        return $this->model->findById($id)->delete();
    }
}
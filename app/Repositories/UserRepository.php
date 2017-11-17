<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:52 PM
 */
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\User;

class UserRepository implements RepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::with('subscription')->get();
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }


    public function find($column, $attribute)
    {
        // TODO: Implement find() method.
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return User::find($attribute);
    }
}
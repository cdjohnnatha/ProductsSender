<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/23/17
 * Time: 11:41 PM
 */

namespace App\Repositories;


use App\Company;
use App\Repositories\Interfaces\RepositoryInterface;

class CompanyRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store($request)
    {
        return $this->model->create($request->all());
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findById($attribute)
    {
        // TODO: Implement findById() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/23/17
 * Time: 11:41 PM
 */

namespace App\Repositories;

use App\Entities\Company\CompanyAddons;
use App\Repositories\Interfaces\RepositoryInterface;

class CompanyAddonsRepository implements RepositoryInterface
{
    private $model;

    public function __construct(CompanyAddons $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store($request)
    {
        return $this->model->create($request->input('addon'));
    }

    public function update($id, $request)
    {
        $addon = $this->model->find($id);
        return $addon->update($request->input('addon'));

    }

    public function findById($attribute)
    {
        return $this->model->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
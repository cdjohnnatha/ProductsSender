<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/23/17
 * Time: 11:41 PM
 */

namespace App\Repositories;

use App\Entities\Company\Warehouse\FeeRules;
use App\Repositories\Interfaces\RepositoryInterface;

class CompanyWarehouseFeesRepository implements RepositoryInterface
{
    private $model;

    public function __construct(FeeRules $model)
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
        $addon = $this->model->find($id);
        return $addon->update($request->all());

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
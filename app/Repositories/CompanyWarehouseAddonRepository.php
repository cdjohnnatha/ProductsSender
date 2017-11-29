<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 5:26 PM
 */

namespace App\Repositories;

use App\CompanyWarehouseAddons;
use App\Repositories\Interfaces\RepositoryInterface;

class CompanyWarehouseAddonRepository implements RepositoryInterface
{

    private $model;


    public function __construct(CompanyWarehouseAddons $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::with('companyWarehouse', 'companyAddons')->get();
    }

    public function store($request)
    {


    }

    public function update($id, $request)
    {


    }

    public function findById($attribute)
    {

    }

    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }
}
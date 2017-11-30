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
        return $this->model->with('phones', 'address', 'addons')->get();
    }

    public function store($request)
    {
        $company = $this->model->create($request->input('company'));
        $company->address()->create($request->input('address'));
        $company->phones()->createMany($request->input('phones'));
    }

    public function update($id, $request)
    {
        $company = $this->model->find($id);
        $company->update($request->input('company'));
        $company->address()->update($request->input('address'));
        foreach ($request->input('phones') as $phone) {
            $company->phones()->updateOrCreate(
                ['id' => (int)$phone['id']],
                ['number' => $phone['number']]);
        }
    }

    public function findById($attribute)
    {
        return $this->model->with(['address', 'phones'])->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:52 PM
 */

namespace App\Repositories;

use App\Address;
use App\Client;
use App\ClientAddressGeoname;
use App\ClientDocuments;
use App\Mail\UserRegisterConfirmation;
use App\PackageStatus;
use App\Repositories\Interfaces\RepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PackageStatusRepository implements RepositoryInterface
{
    private $model;

    public function __construct(PackageStatus $model)
    {
        $this->model = $model;

    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function store($request)
    {
        return $this->model->create($request->input('package_status'));

    }

    public function update($id, $request)
    {
        return $this->model->update($request->input('package_status'));
    }



    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return $this->model::find($attribute);
    }

}
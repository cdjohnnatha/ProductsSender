<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 10:49 PM
 */

namespace App\Repositories;


use App\Entities\Package\Package;
use App\Entities\Package\PackageFiles;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\Storage;

class PackageRepository implements RepositoryInterface
{

    private $model;
    private $allRelations;

    public function __construct(Package $package)
    {
        $this->model = $package;

        $this->allRelations = [
            'client',
            'packageStatus',
            'pictures',
            'goodsDeclaration',
            'packageOrder'
        ];
    }

    public function getAll()
    {
        return $this->model->with($this->allRelations)->paginate(50);
    }

    public function getCompaniesAllPackages()
    {
//        return $this->model->where('');
    }

    public function getPackagesByStatus($statusType)
    {
        return $this->model->whereHas('packageStatus', function($query) use ($statusType) {
                    $query->where('message','like', $statusType);
                })
            ->orderBy('created_at', 'desc')
            ->paginate(50);
    }

    public function getPackagesByStatusClient($clientId, $statusType)
    {
        return $this->model
            ->where('client_id', $clientId)
            ->whereHas('packageStatus', function($query) use ($statusType) {
                $query->where('message','like', $statusType);
            })
            ->with($this->allRelations)
            ->orderBy('created_at', 'desc')
            ->paginate(50);
    }

    public function getUserPackages($userId)
    {
        return $this->model
            ->whereHas('user_id', $userId)
            ->with($this->allRelations)
            ->paginate(30);
    }



    public function store($request)
    {
        $package = $this->model->create($request->input('package'));
        if($request->has('custom_clearance')) {
            $package->goodsDeclaration()->createMany($request->input('custom_clearance'));
        }

        if($request->hasFile('package_files')) {
            $this->saveImage($request->file('package_files'), $package);
        }

        return $package;
    }

    public function update($id, $request)
    {
        $package = Package::findOrFail($id);
        $package->update($request->input('package'));

        if($request->has('custom_clearance')) {

            foreach ($request->input('custom_clearance') as $goods) {
                if (isset($goods['id'])) {
                    $package->goodsDeclaration()->updateOrCreate(
                        ['id' => $goods['id']],
                        $goods
                    );
                } else {
                    $package->goodsDeclaration()->create($goods);
                }
            }
        }

        if($request->hasFile('package_files')) {
            $this->saveImage($request->file('package_files'), $package);
        }

    }

    public function findById($attribute)
    {
        return Package::with([
            'pictures',
            'companyWarehouse',
            'packageStatus',
            'client',
            'goodsDeclaration',
            'packageOrder'
        ])->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    private function saveImage($files, $package)
    {
        foreach ($files as $key=>$file) {
            $fileName = $package->id . date("dmYhmsu");
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = md5($fileName.$key) . '.' . $extension;
            $path = $file->storeAs('public/PackagePictures', $fileName);
            $path = str_replace('public', 'storage', $path);
            $picture = $package->pictures()->create(['name' => $fileName, 'path' => '/'.$path]);

            if ($picture) {
                activity()
                    ->performedOn($package)
                    ->causedBy($package->client->id)
                    ->withProperty('package_id', $package->id)
                    ->withProperty('file_name', $fileName)
                    ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
            }
        }
    }

    public function destroyImage($id)
    {
        $file = PackageFiles::find($id);

        if($file) {
            Storage::delete(config('constants.files.full_public_path').$file->name);
        }

        $file->delete();
    }
}
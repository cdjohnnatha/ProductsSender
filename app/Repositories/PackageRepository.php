<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 10:49 PM
 */

namespace App\Repositories;


use App\Package;
use App\Repositories\Interfaces\RepositoryInterface;

class PackageRepository implements RepositoryInterface
{

    private $model;

    public function __construct(Package $package)
    {
        $this->model = $package;
    }

    public function getAll()
    {
        return $this->model->with('packageStatus', 'client')->paginate(50);
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



    public function store($request)
    {
        $package = $this->model->create($request->input('package'));
        if($request->has('custom_clearance')) {
            $package->packageGoodsDeclaration()->createMany($request->input('custom_clearance'));
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
            $package->packageGoodsDeclaration()->createMany($request->input('custom_clearance'));
        }

        if($request->hasFile('package_files')) {
            $this->saveImage($request->file('package_files'), $package);
        }



    }

    public function findById($attribute)
    {
        return Package::with([
            'pictures',
            'warehouse',
            'packageStatus',
            'client',
            'packageGoodsDeclaration',
            'order'
        ])->find($attribute);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
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
}
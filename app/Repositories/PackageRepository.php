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
        return $this->model->paginate(50);
    }

    public function getCompaniesAllPackages()
    {
//        return $this->model->where()
    }

    public function getIndexPackages($field, $id, $sent)
    {
        return $this->model::with(['status', 'pictures', 'warehouse', 'goods'])
            ->where($field, $id)
            ->where('sent', $sent)
            ->orderBy('created_at', 'desc')
            ->get();
    }



    public function store($request)
    {
//        $package = new $this->model::create($request->input('package'));
//        $package->status_id = $request->input('status.status_id');
//        $package->warehouse_id = $request->input('warehouse_id');
//
//        $package->save();
//
//        if($request->hasFile('package_files')) {
//            $this->saveImage($request->file('package_files'), $package);
//        }
//
//        if($request->exists('incoming')){
//            $incoming = IncomingPackages::find($request->input('incoming'));
//            $incoming->registered = true;
//            $package->goods()->save($incoming);
//        }
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

    private function saveImage($files, $package){
        foreach ($files as $key=>$file) {
            $fileName = $package->id . date("dmYhmsu");
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = md5($fileName.$key) . '.' . $extension;
            $path = $file->storeAs('public/PackagePictures', $fileName);
            $path = str_replace('public', 'storage', $path);
            $picture = new PackageFiles();
            $picture->name = $fileName;
            $picture->path = '/'.$path;
            if ($package->pictures()->save($picture)) {
                activity()
                    ->performedOn($package)
                    ->causedBy(Auth::user())
                    ->withProperty('package_id', $package->id)
                    ->withProperty('file_name', $fileName)
                    ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
            }
        }
    }
}
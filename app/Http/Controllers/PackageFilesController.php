<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PackageFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function delete($idPackage, $fileId)
    {
        $file = PackageFiles::findOrFail($fileId);
        Storage::delete(config('full_public_path').$file->name);
        $file->delete();
        if($file->trashed()){
            activity()
                ->performedOn($file)
                ->causedBy(Auth::user())
                ->withProperty('package_id', $idPackage)
                ->withProperty('file_name', $file->name)
                ->log('The package id is :properties.package_id, 
                            the causer name is :causer.name and removing the file :properties.file_name 
                            with id:');
            return response('removed', 200);

        }

        return response('error while deleting at database', 417);
    }

}

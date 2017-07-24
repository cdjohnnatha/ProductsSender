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
            return response('removed', 200);

        }

        return response('error while deleting at database', 417);
    }

}

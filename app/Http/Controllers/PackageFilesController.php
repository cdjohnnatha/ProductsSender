<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PackageFilesController extends Controller
{

    //TODO: qual o motivo desse controlador?
    public function destroy($fileId){
        $file = PackageFiles::findOrFail($fileId);
        Storage::delete(config('full_public_path').$file->name);
        $file->delete();
        if($file->trashed()){
            return redirect()->back();
        }
    }

}

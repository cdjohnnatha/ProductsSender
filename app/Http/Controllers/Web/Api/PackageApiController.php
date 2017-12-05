<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 12/5/17
 * Time: 5:19 PM
 */

namespace App\Http\Controllers\Web\Api;


use App\Repositories\PackageRepository;

class PackageApiController
{
    private $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function destroyFile($id)
    {
        return $this->packageRepository->destroyImage($id);
    }

}
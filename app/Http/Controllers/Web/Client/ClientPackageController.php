<?php

namespace App\Http\Controllers\Web\Client;

use App\Entities\Package\Package;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyWarehouseRepository;
use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\Auth;

class ClientPackageController extends Controller
{
    private $packageRepository;
    private $companyWarehouseRepository;

    public function __construct(PackageRepository $packageRepository, CompanyWarehouseRepository $companyWarehouseRepository)
    {
        $this->packageRepository = $packageRepository;
        $this->companyWarehouseRepository = $companyWarehouseRepository;
    }

    public function index()
    {
        $client = Auth::user()->client;
        $packagesRegistered = $this->packageRepository->getPackagesByStatusClient($client->id, 'REGISTERED');
        $packagesIncoming = $this->packageRepository->getPackagesByStatusClient($client->id, 'INCOMING');
        $packagesSent = $this->packageRepository->getPackagesByStatusClient($client->id, 'SENT');
        return view('package.client.index', compact('packagesRegistered', 'packagesIncoming', 'packagesSent'));
    }

    public function show($id)
    {
        $package = $this->packageRepository->findById($id);
        return view('package.show', compact('package'));
    }

    public function create()
    {
        $warehouses = $this->companyWarehouseRepository->getAll();
        return view('package.client.create', compact('warehouses'));
    }

    public function store()
    {

    }


    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

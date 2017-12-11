<?php

namespace App\Http\Controllers\Web\Client;

use App\Entities\Package\Package;
use App\Http\Controllers\Controller;
use App\Library\WizardSteps;
use App\Repositories\CompanyWarehouseRepository;
use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPackageController extends Controller
{
    private $packageRepository;
    private $companyWarehouseRepository;
    private $steps;

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
        $steps = 1;
        return view('package.client.wizard.create_step_1', compact('warehouses', 'steps'));
    }

    public function wizard(Request $request)
    {
        $page = 'package.client.wizard.create_step_';
        $steps = $request->input('step');
        $package = $request->input();
        switch ($steps) {
            case 1:
                $this->validate($request,[
                    'package.provider' => 'required',
                    'package.addressee' => 'required',
                    'package.company_warehouse_id' => 'required',
                    'package.track_number' => 'required',
                    'package.content_type' => 'required|string',
                    'package.description' => 'required',
                    'package.total_goods' => 'required',
                    'custom_clearance' => 'required|array|min:1',
                    'custom_clearance.*.description' => 'required|string',
                    'custom_clearance.*.quantity' => 'required|integer|min:1',
                    'custom_clearance.*.unit_price' => 'required',
                    'custom_clearance.*.total_unit' => 'required',
                ]);
                $steps = ++$steps;
                $page = $page . $steps;
                $warehouses = $this->companyWarehouseRepository->findById($request->input('package.company_warehouse_id'));
                break;
            case 2:
                $steps = --$steps;
                $page = $page . $steps;
                $warehouses = $this->companyWarehouseRepository->getAll();
                break;

        }
//        dd($package);
        return view($page, compact('package', 'warehouses', 'steps'));


    }

    public function store(Request $request)
    {
//        dd($request->input());
//        dd($request->all());
        if($this->packageRepository->store($request)) {
            return redirect( route('user.packages.index') );
        }
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

<?php

namespace App\Http\Controllers\Web\Client;

use App\Entities\Package\Package;
use App\Http\Controllers\Controller;
use App\Library\Services\Shipment;
use App\Library\Services\ShipmentInterface;
use App\Library\WizardSteps;
use App\Repositories\CompanyWarehouseRepository;
use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//TODO update incoming, edit incoming for users. destroy incoming.
class ClientPackageController extends Controller
{
    private $packageRepository;
    private $companyWarehouseRepository;
    private $shipment;

    public function __construct(
        PackageRepository $packageRepository,
        CompanyWarehouseRepository $companyWarehouseRepository,
        Shipment $shipment
    )
    {
        $this->packageRepository = $packageRepository;
        $this->companyWarehouseRepository = $companyWarehouseRepository;
        $this->shipment = $shipment;
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
        return view($page, compact('package', 'warehouses', 'steps'));


    }

    public function store(Request $request)
    {
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

    public function processPackageWizard(Request $request)
    {
        $steps = $request->input('step');
        $page = 'package.client.sendPackage.send_wizard_';

        switch($steps) {
            case 1:
                $validator = Validator::make($request->all(), [
                    'packages_id' => 'required|array|min:1'
                ]);
                if($validator->fails()){
                    $data = $request->except(['next']);
                    return view('package.client.sendPackage.send_wizard_1', compact('data'))->withErrors($validator);
                }
                ++$steps;
                $page .= $steps;
                $data['packages_id'] = $request->input('packages_id');
                $data['step'] = $steps;
                $data['warehouses'] = $this->packageRepository->findById($data['packages_id'][0])->companyWarehouse;
                return view($page, compact('data'));


            case 2:
                if($request->has('next')){
                    $steps++;
                    $data = $request->except('_token', 'next');
                    $data['rates'] = $this->shipment->getRates($request->input('packages_id'), null);
                } else {
                    $steps--;
                    $data['packages'] = $this->packageRepository->processPackage($request);
                }
                $page .= $steps;
                $data['step'] = $steps;
                break;
            case 3:
                break;

            default:
                $this->validate($request, ['packages_id' => 'required|array|min:1']);
                $packages = $this->packageRepository->processPackage($request);
                if($packages){
                    $data['step'] = 1;
                    $data['packages'] = $packages;
                    return view('package.client.sendPackage.send_wizard_1', compact('data'));
                } else {
                    return redirect()->back();
                }
        }

        return view($page, compact('data'));
    }
}

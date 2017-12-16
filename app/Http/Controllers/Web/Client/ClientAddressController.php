<?php

namespace App\Http\Controllers\Web\Client;

use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Repositories\Client\ClientAddressRepository;
use App\Repositories\CompanyWarehouseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientAddressController extends Controller
{
    private $clientAddressRepository;
    private $companyWarehouse;

    public function __construct(ClientAddressRepository $clientAddressRepository, CompanyWarehouseRepository $companyWarehouse)
    {
        $this->clientAddressRepository = $clientAddressRepository;
        $this->companyWarehouse = $companyWarehouse;
    }

    public function index()
    {
        $addresses = $this->clientAddressRepository->getAll(Auth::user()->client->id);
        $warehouses = $this->companyWarehouse->getAll();
        return view('user.address.index', compact('addresses', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->clientAddressRepository->store(Auth::user()->client, $request)){
            return redirect()->to(route('user.addresses.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = $this->clientAddressRepository->findById($id);
        return view('user.address.create', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->clientAddressRepository->update($id, $request->input('address'))){
            return redirect()->to(route('user.addresses.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->clientAddressRepository->destroy($id)) {
            return redirect()->to(route('user.addresses.index'));
        }
    }

    public function defaultAddress($id)
    {
        if( $this->clientAddressRepository->makeDefault(Auth::user()->client, $id) ){
            return redirect()->back();
        }
    }
}

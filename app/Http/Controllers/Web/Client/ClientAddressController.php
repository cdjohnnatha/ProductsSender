<?php

namespace App\Http\Controllers\Web\Client;

use App\Repositories\Client\ClientAddressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientAddressController extends Controller
{
    private $clientAddressRepository;

    public function __construct(ClientAddressRepository $clientAddressRepository)
    {
        $this->clientAddressRepository = $clientAddressRepository;
    }

    public function index()
    {
        $addresses = $this->clientAddressRepository->getAll(Auth::user()->client->id);
        return view('user.address.index', compact('addresses'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function defaultAddress($id)
    {
        if( $this->clientAddressRepository->makeDefault(Auth::user()->client, $id) ){
            return redirect()->back();
        }
    }
}

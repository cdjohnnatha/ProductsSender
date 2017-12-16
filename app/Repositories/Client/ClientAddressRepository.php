<?php

namespace App\Repositories\Client;


use App\Entities\Client\ClientAddress;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Log;

class ClientAddressRepository
{
    private $model;
    private $clientRepository;

    public function __construct(ClientAddress $model, ClientRepository $clientRepository)
    {
        $this->model = $model;
        $this->clientRepository = $clientRepository;
    }

    public function getAll($clientId)
    {
        return $this->model->where('client_id', $clientId)->get();
    }

    public function store($client, $request)
    {
        return $client->address()->create($request->input('address'));
    }

    public function update($id, $attributes)
    {
        $address = $this->model->find($id);
        return $address->update($attributes);
    }

    public function destroy($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return $this->model->find($attribute);
    }

    public function makeDefault($client, $id)
    {
        $client = $this->clientRepository->findById($client->id);
        return $client->update(['default_address' => $id]);
    }

}
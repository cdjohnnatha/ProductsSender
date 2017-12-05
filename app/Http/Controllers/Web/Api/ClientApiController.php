<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;

class ClientApiController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function findSuite($id)
    {
        $client = $this->clientRepository->findById($id);
        return $client;

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 26/01/18
 * Time: 21:20
 */

namespace App\Repositories;

use App\Entities\PaymentTransaction;

class TransactionRepository
{
    private $model;

    public function __construct(PaymentTransaction $transaction)
    {
        $this->model = $transaction;
    }

    public function getAll($clientId)
    {
        return $this->model->where('client_id', $clientId)->get();
    }

    public function getBalance($clientId)
    {
        return $this->model->where('client_id', $clientId)->get()->sum('amount');
    }

    public function store($request)
    {
        return $this->model->create($request->all());
    }

    public function createFromInvoice($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findById($attribute)
    {
        // TODO: Implement findById() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
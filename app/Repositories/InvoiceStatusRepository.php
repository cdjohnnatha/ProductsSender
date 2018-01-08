<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Invoice\InvoiceStatus;
use App\Entities\Order\OrderStatus;

class InvoiceStatusRepository
{

    private $model;

    public function __construct(InvoiceStatus $invoiceStatus)
    {
        $this->model = $invoiceStatus;
    }

    public function getAll()
    {
        return $this->model->paginate(30);
    }

    public function store($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findById($attribute)
    {
        return $this->model->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function findByMessage($message)
    {
        return $this->model->where('message', 'like', $message)->first();
    }
}
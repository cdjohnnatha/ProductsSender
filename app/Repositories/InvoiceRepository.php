<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Invoice;

class InvoiceRepository
{

    private $model;
    private $allRelations;

    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
        $this->allRelations = [
            'invoiceOrder',
            'invoiceStatus',
            'invoiceTransaction'
        ];
    }

    public function getAll()
    {
        return $this->model->with($this->allRelations)->paginate(30);
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
}
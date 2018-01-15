<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Invoice\Invoice;

class InvoiceRepository
{

    private $model;
    private $allRelations;
    private $invoiceStatusRepository;
    private $clientRepository;

    public function __construct(Invoice $invoice, InvoiceStatusRepository $invoiceStatusRepository, ClientRepository $clientRepository)
    {
        $this->model = $invoice;
        $this->invoiceStatusRepository = $invoiceStatusRepository;
        $this->clientRepository = $clientRepository;
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

    public function store($attributes, $status=null)
    {
        if(is_null($status)){
            $attributes['invoice_status_id'] = $this->invoiceStatusRepository->findByMessage('WAITING_PAYMENT')->id;
        } else {
            $attributes['invoice_status_id'] = $this->invoiceStatusRepository->findByMessage($status)->id;
        }
        return $this->model->create($attributes);
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findById($attribute)
    {
        return $this->model->with($this->allRelations)->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getAllByClient($clientId)
    {
        $client = $this->clientRepository->findById($clientId);
        return $client->invoices;
    }
}
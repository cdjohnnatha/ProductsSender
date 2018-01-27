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
    private $transactionRepository;

    public function __construct(
        Invoice $invoice,
        InvoiceStatusRepository $invoiceStatusRepository,
        ClientRepository $clientRepository,
        TransactionRepository $transactionRepository
    )
    {
        $this->model = $invoice;
        $this->invoiceStatusRepository = $invoiceStatusRepository;
        $this->clientRepository = $clientRepository;
        $this->transactionRepository = $transactionRepository;
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

    }

    public function makePayment($client, $request)
    {
        $balance = $client->walletResult();
        $invoiceTotal = 0;
        $invoicesArr = array();
        foreach ($request->input('invoices_id') as $invoice) {
            $invoice = $this->findById($invoice);
            $invoiceTotal += $invoice->amount;
            array_push($invoicesArr, $invoice);
        }

        if($invoiceTotal > $balance) {
            return false;
        } else {
            foreach($invoicesArr as $invoice){
                if($this->transactionRepository->createFromInvoice([
                    'client_id' => $invoice->client_id,
                    'amount' => -$invoice->amount,
                    'payment_type' => 'Invoice'
                ])){
                    $this->updateStatus($invoice, 'PAYED');
                }
            }
            return true;
        }
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

    public function getNotPayedList($clientId)
    {
        $payedStatus = $this->invoiceStatusRepository->findByMessage('PAYED');
        return $this->model
            ->with($this->allRelations)
            ->where('client_id', $clientId)
            ->where('invoice_status_id', '!=', $payedStatus->id)->get();
    }

    public function updateStatus($invoice, $status)
    {
        $status = $this->invoiceStatusRepository->findByMessage($status);
        $invoice->update(['invoice_status_id' => $status->id]);
    }
}
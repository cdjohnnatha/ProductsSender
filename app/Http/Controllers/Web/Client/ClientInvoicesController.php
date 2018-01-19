<?php

namespace App\Http\Controllers\Web\Client;

use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientInvoicesController extends Controller
{
    private $invoiceRepository;
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        $data['invoices'] = $this->invoiceRepository->getAllByClient(Auth::user()->client->id);
        return view('invoice.index', compact('data'));
    }


    public function show($id)
    {
        $data['invoice'] = $this->invoiceRepository->findById($id);
        return view('invoice.show', compact('data'));
    }
}

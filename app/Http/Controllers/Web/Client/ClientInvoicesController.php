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
        $data['history'] = $this->invoiceRepository->getAllByClient(Auth::user()->client->id);
        $data['invoices'] = $this->invoiceRepository->getNotPayedList(Auth::user()->client->id);

        return view('invoice.index', compact('data'));
    }


    public function show($id)
    {
        $data['invoice'] = $this->invoiceRepository->findById($id);
        return view('invoice.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'invoices_id' => 'required|array|min:1'
        ]);

        if($this->invoiceRepository->makePayment(Auth::user()->client, $request)){
          return redirect(route('user.payment_transactions.index'));
        }

        $request->session()->flash('error', 'Not Enough money at wallet! Please try again');
        return redirect()->back();
    }

}

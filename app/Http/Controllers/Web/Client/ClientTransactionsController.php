<?php

namespace App\Http\Controllers\Web\Client;

use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientTransactionsController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        $data['paymentTransaction'] = $this->transactionRepository->getAll(Auth::user()->client->id);
        return view('paymentTransaction.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentTransaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'payment_type' => 'required',
            'amount' => 'required|min:0.01',
        ]);
        if ( $this->transactionRepository->store($request) ) {
            return redirect(route('user.payment_transactions.index'));
        }
    }

}

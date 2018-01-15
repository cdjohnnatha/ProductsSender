<?php

namespace App\Http\Controllers\Web\Client;

use App\Repositories\InvoiceRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    private $orders;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orders = $orderRepository;
    }

    public function index()
    {
        $data['inbox'] = $this->orders->listByUserStatusOrder(Auth::user()->client->id, 'WAITING_PAYMENT');
        return view('client.order.index', compact('data'));
    }



    public function show($id)
    {
        $data['order'] = $this->orders->findById($id);
        dd($data['order']->orderFeeRules);
        return view('client.order.show', compact('data'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

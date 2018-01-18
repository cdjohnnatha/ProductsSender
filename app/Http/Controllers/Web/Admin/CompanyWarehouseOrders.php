<?php

namespace App\Http\Controllers\Web\Admin;

use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyWarehouseOrders extends Controller
{
    private $orderRepository;
    private $orderStatusRepository;

    public function __construct(OrderRepository $orderRepository, OrderStatusRepository $orderStatusRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($companyId, $warehouseId, $id)
    {
        $data['order'] = $this->orderRepository->findById($id);
        $data['companyId'] = $companyId;
        $data['warehouseId'] = $warehouseId;
        $data['orderStatus'] = $this->orderStatusRepository->getAll();
        return view('company.warehouse.order.show', compact('data'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $companyId, $warehouseId, $id)
    {
        if($this->orderRepository->update($id, $request)) {
            return redirect()->route('admin.companies.warehouses.show', [$companyId, $warehouseId]);
        }
    }

    public function destroy($id)
    {
        //
    }
}

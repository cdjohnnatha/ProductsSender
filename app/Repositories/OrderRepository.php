<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Order\Order;
use Webpatser\Uuid\Uuid;

class OrderRepository
{

    private $model;
    private $allRelations;
    private $orderStatusRepository;

    public function __construct(Order $order, OrderStatusRepository $orderStatusRepository)
    {
        $this->model = $order;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->allRelations = [
            'orderStatus',
            'orderPackages',
            'client'
        ];
    }

    public function getAll()
    {
        return $this->model->with($this->allRelations)->paginate(30);
    }

    public function store($clientId, $companyWarehouseId, $status=null)
    {
        $attributes['client_id'] = $clientId;
        $attributes['company_warehouse_id'] = $companyWarehouseId;
        try {
            $attributes['uuid'] = Uuid::generate();
        } catch (\Exception $e) {
        }

        if(is_null($status)){
            $attributes['order_status_id'] = $this->orderStatusRepository->findByMessage('WAITING_PAYMENT')->id;
        } else {
            $attributes['order_status_id'] = $this->orderStatusRepository->findByMessage($status)->id;
        }
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

    public function calculateTotalOrderAddons($orderId)
    {
        $orderPackagesArr = $this->findById($orderId)->orderPackages;
        $total_addons = 0;
        foreach ($orderPackagesArr as $orderPackage){
            $total_addons += $orderPackage->orderAddons()->sum('price');
        }
        return $total_addons;
    }

    public function calculateTotalOrderFowards($orderId)
    {
        $orderPackagesArr = $this->findById($orderId)->orderFowards()->get();
        $total_fowards = 0;
        foreach ($orderPackagesArr as $orderFowards){
            $total_fowards += $orderFowards->sum('price');
        }
        return $total_fowards;
    }

    public function calculateTotalOrderFees($orderId)
    {
        $orderFeesRulesArr = $this->findById($orderId)->orderFeeRules()->get();
        $total_fees = 0;
        foreach ($orderFeesRulesArr as $orderFees){
            $total_fees += $orderFees->sum('price');
        }
        return $total_fees;
    }

    public function calculateTotalOrderFeeWeightRules($orderId)
    {
        $orderPackagesArr = $this->findById($orderId)->orderPackages()->get();
        $total_weight_fee = 0;
        foreach ($orderPackagesArr as $orderPackage){
            $total_weight_fee += $orderPackage->orderFeeWeightRules()->sum('total');
        }
        return $total_weight_fee;
    }

    public function calculateTotalOrder($orderId)
    {
        $total = $this->calculateTotalOrderFowards($orderId);
        $total += $this->calculateTotalOrderAddons($orderId);
        $total += $this->calculateTotalOrderFees($orderId);
        $total += $this->calculateTotalOrderFeeWeightRules($orderId);
        return $total;
    }

    public function listByUserStatusOrder($clientId, $message)
    {
        $message = $this->orderStatusRepository->findByMessage($message)->id;
        return $this->model->with($this->allRelations)->where('client_id', $clientId)->where('order_status_id', $message)->get();
    }
}
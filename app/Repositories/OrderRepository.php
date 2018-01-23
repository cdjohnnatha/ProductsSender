<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Order\Order;
use App\Entities\Package\Package;
use App\Library\Services\Shipment;
use Webpatser\Uuid\Uuid;

class OrderRepository
{

    private $model;
    private $allRelations;
    private $orderStatusRepository;
    private $orderFowardRepository;
    private $invoiceStatusRepository;
    private $packageStatusRepository;
    private $shipment;

    public function __construct
    (
        Order $order,
        OrderStatusRepository $orderStatusRepository,
        OrderFowardRepository $orderFowardRepository,
        InvoiceStatusRepository $invoiceStatusRepository,
        PackageStatusRepository $packageStatusRepository,
        Shipment $shipment
    )
    {
        $this->model = $order;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->orderFowardRepository = $orderFowardRepository;
        $this->invoiceStatusRepository = $invoiceStatusRepository;
        $this->shipment = $shipment;
        $this->packageStatusRepository = $packageStatusRepository;
        $this->allRelations = [
            'orderStatus',
            'orderPackages',
            'client',
            'invoiceOrder'
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
            $attributes['order_status_id'] = $this->orderStatusRepository->findByMessage('ORDERED')->id;
        } else {
            $attributes['order_status_id'] = $this->orderStatusRepository->findByMessage($status)->id;
        }
        return $this->model->create($attributes);
    }


    public function update($id, $request)
    {
        $order = $this->findById($id);
        if($request->has('order_status_id')) {
            $status = $this->orderStatusRepository->findById($request->input('order_status_id'));

            if($status->message === 'SENT') {
                $approved = $this->statusApprovalMachine($order);
//                if($approved && $request->has('order_fowards')) {

//                } else {
                    $request->session()->flash('warning', __('order.warehouse.warning'));
//                }
                return $order;
            }
        }

        return $order->update($request->all());
    }

    public function findById($attribute)
    {
        return $this->model->with($this->allRelations)->find($attribute);
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
        return $orderPackagesArr->sum('price');

    }

    public function calculateTotalOrderFees($orderId)
    {
        $orderPackages = $this->findById($orderId)->orderPackages()->get();
        $totalOrderFee = 0;
        foreach($orderPackages as $orderPackage) {
            $totalOrderFee += $orderPackage->orderPackageFeeRules()->sum('price');
        }
        return $totalOrderFee;
    }

    public function calculateTotalOrderFeeWeightRules($orderId)
    {
        $orderPackagesArr = $this->findById($orderId)->orderPackages()->get();

        $total_weight_fee = 0;
        foreach ($orderPackagesArr as $orderPackage){
            $total_weight_fee += $orderPackage->orderFeeWeightRules()->first()->total;
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

    public function statusApprovalMachine($order)
    {
        $invoiceStatus = $order->invoiceOrder->first()->invoiceStatus;
        $payedStatus = $this->invoiceStatusRepository->findByMessage('PAYED');
        $apiErrors = array();
//        if($payedStatus->message === $invoiceStatus->message) {
            $sentStatus = $this->orderStatusRepository->findByMessage('SENT');
            $order->update(['order_status_id' => $sentStatus->id]);

                foreach($order->orderFowards as $foward){
                    $transaction = $this->shipment->createTransaction($foward);
                    if($transaction['status'] == "SUCCESS"){
                        $foward->update(['track_number' => $transaction['tracking_number']]);
                        $sentPackageStatus = $this->packageStatusRepository->getStatusFromMessage('SENT');
                        $foward->package()->update(['package_status_id' => $sentPackageStatus->id]);
                    } else {
                        $tmpError = array();
                        $tmpError['status'] = $transaction['status'];
                        $tmpError['messages'] = $transaction['messages'];
                        array_push($apiErrors, $tmpError);
                    }
                }

            return $apiErrors;
    }
}
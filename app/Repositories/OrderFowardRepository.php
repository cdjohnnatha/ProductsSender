<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Order\Order;
use App\Entities\Order\OrderFoward;
use Webpatser\Uuid\Uuid;

class OrderFowardRepository
{

    private $model;
    private $orderRepository;

    public function __construct(OrderFoward $order)
    {
        $this->model = $order;
        $this->allRelations = [
            'address',
        ];
    }

    public function getAll()
    {
        return $this->model->with($this->allRelations)->paginate(30);
    }

    public function store($orderId, $shipmentInfo)
    {
        $shipmentInfo['order_id'] = $orderId;

        return $this->model->create($shipmentInfo);
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
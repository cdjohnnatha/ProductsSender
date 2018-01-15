<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 23/12/17
 * Time: 19:24
 */

namespace App\Repositories;

use App\Entities\Order\Order;
use App\Entities\Order\OrderFeeRules;
use Webpatser\Uuid\Uuid;

class OrderFeeRulesRepository
{

    private $model;

    public function __construct(OrderFeeRules $orderFeeRules)
    {
       $this->model = $orderFeeRules;
    }

    public function getAll()
    {
        return $this->model->paginate(30);
    }

    public function store($order, $fees)
    {
        return $order->orderFeeRules()->create([
            'price' => $fees->amount,
            'fee_rules_id' => $fees->id
        ]);
    }

    public function update($id, $request)
    {
       $fees = $this->findById($id);
       return $fees->update($request->input());
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
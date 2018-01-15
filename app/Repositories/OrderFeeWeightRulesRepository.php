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
use App\Entities\Order\OrderFeeWeightRules;
use Webpatser\Uuid\Uuid;

class OrderFeeWeightRulesRepository
{

    private $model;

    public function __construct(OrderFeeWeightRules $orderFeeWeightRules)
    {
       $this->model = $orderFeeWeightRules;
    }

    public function getAll()
    {
        return $this->model->paginate(30);
    }

    public function store($warehouse, $orderPackage, $weight)
    {
        $overweight = 0;

        if($weight <= $warehouse->feeWeightRules->max_initial_weight){
            $weightFee = $warehouse->feeWeightRules->initial_fee;
        } else if($weight <= $warehouse->feeWeightRules->max_weight) {
            $weightFee = $warehouse->feeWeightRules->max_weight_fee;

        } else {
            $weightFee = $warehouse->feeWeightRules->max_weight_fee;
            $overweight = ($weight - $warehouse->feeWeightRules->max_weight) / $warehouse->feeWeightRules->overweight;
            $weightFee += ($overweight * $warehouse->feeWeightRules->overweight_fee);
        }

        return $this->model->create([
            'fee_weight_rules_id' => $warehouse->feeWeightRules->id,
            'total' => $weightFee,
            'overweight' => $overweight,
            'order_package_id' => $orderPackage->id
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
<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/7/17
 * Time: 1:36 AM
 */

namespace App\Library\Shipment;


class Items
{
    private $items;

    function __construct($items)
    {
        $this->items = array();

        foreach($items as $goods){
            $item = array(
                "description" => $goods->description,
                "quantity" => $goods->quantity,
                "value_amount" => $goods->total_unit,
                "value_currency"=> "USD",
                "metadata" => "Customs Item",
                "origin_country" => "US"
            );
            array_push($this->items, $item);
        }
    }

    function getItems()
    {
        return $this->items;
    }

    function setItems($items)
    {
        $this->items = $items;
    }

}
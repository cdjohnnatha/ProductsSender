<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Package;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class ShipmentApiController extends Controller
{
    public function shipmentRates(Request $request)
    {

        $packages = Package::with('warehouse')->find($request->input('package'));
        $address = Address::find($request->input('address'));

        $address_from = array(
            'name' => $packages->warehouse->address->owner_name .' '. $packages->warehouse->address->owner_surname,
            'street1' => $packages->warehouse->address->street,
            'city' => $packages->warehouse->address->city,
            'state' => $packages->warehouse->address->state,
            'zip' => $packages->warehouse->address->postal_code,
            'country' => 'US',
            'phone' => $packages->warehouse->address->phone,
            'email' => 'cdjohnnatha@gmail.com'
        );

        $address_to = array(
            'name' => $address->name,
            'street1' => $address->street,
            'city' => $address->city,
            'state' => $address->state,
            'zip' => $address->postal_code,
            'country' => 'BR',
            'phone' => $address->phone,
            'email' => 'cdjohnnatha@gmail.com'
        );

        $items = array();

        foreach($packages->goods->goodsDeclaration as $goods){
            $item = array(
                "description" => $goods->description,
                "quantity" => $goods->quantity,
                "value_amount" => $goods->total_unit,
                "value_currency"=> "USD",
                "metadata" => "Customs Item",
                "origin_country" => "US"
            );
            array_push($items, $item);
        }


        $custom_declaration = array(
            "contents_type" => $packages->goods->content_type ? "MERCHANDISE" : 'GIFT',
            "contents_explanation" => $packages->goods->description,
            "non_delivery_option" => "RETURN",
            "certify" => true,
            "certify_signer" => "Holyship",
            "items" => $items,
            "metadata" => "Custom declarations"
        );

        $parcels = array(
            "length" => $packages->depth,
            "width" => $packages->width,
            "height" => $packages->height,
            "distance_unit" => $packages->unit_measure,
            "weight" => $packages->weight,
            "mass_unit" => $packages->weight_measure
        );

        return $shipment = \Shippo_Shipment::create(array(
            'address_from' => $address_from,
            'address_to' => $address_to,
            'async' => false,
            'parcels' => array($parcels)
        ));



    }

    public function show()
    {
        return response()->json('worked');
    }
}

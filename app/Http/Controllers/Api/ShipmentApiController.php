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
        Log::info($packages->goods);

        $address_from = array(
            'name' => $packages->warehouse->address->owner_name .' '. $packages->warehouse->address->owner_surname ,
            'street1' => $packages->warehouse->address->street,
            'city' => $packages->warehouse->address->city,
            'state' => $packages->warehouse->address->state,
            'zip' => $packages->warehouse->address->postal_code,
            'country' => 'US',
            'phone' => $packages->warehouse->address->phone,
            'email' => 'cdjohnnatha@gmail.com'
        );

        $address_to = array(
            'name' => $packages->user->name,
            'street1' => $packages->user->defaultAddress->street,
            'city' => $packages->user->defaultAddress->city,
            'state' => $packages->user->defaultAddress->state,
            'zip' => $packages->user->defaultAddress->postal_code,
            'country' => 'BR',
            'phone' => $packages->user->defaultAddress->phone,
            'email' => 'cdjohnnatha@gmail.com'
        );

        $item = array(
            "description" => $packages->goods->description,
            "quantity" => 1,
            "net_weight" => $packages->weight,
            "mass_unit"=> $packages->unit_measure,
            "value_amount" => $packages->goods->total_goods,
            "value_currency"=> "USD",
            "metadata" => "Customs Item",
            "origin_country" => "US"
        );

        $custom_declaration = array(
            "contents_type" => "MERCHANDISE",
            "contents_explanation" => "Shipping done easy",
            "non_delivery_option" => "RETURN",
            "certify" => true,
            "certify_signer" => "Holyship",
            "items" => $item,
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

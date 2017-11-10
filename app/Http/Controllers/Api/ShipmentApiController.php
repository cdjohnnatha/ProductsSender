<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Library\Shipment\CustomDeclaration;
use App\Library\Shipment\Items;
use App\Library\Shipment\Parcels;
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
        $address_to = new \App\Library\Shipment\Address($address);
        $address_from = new \App\Library\Shipment\Address($packages->warehouse->address);
        $items = new Items($packages->goods->goodsDeclaration);
//        $custom_declaration = new CustomDeclaration($packages->goods, $items);
        $parcels = new Parcels($packages);

        return $shipment = \Shippo_Shipment::create(array(
            'address_to' => $address_to->getAddress(),
            'address_from' => $address_from->getAddress(),
            'async' => false,
            'parcels' => $parcels->getParcel()
        ));
    }
}

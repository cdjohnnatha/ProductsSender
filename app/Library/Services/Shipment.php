<?php

namespace App\Library\Services;

use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\Log;
use Shippo_Shipment;

class Shipment
{

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function getRates($packageIds, $address)
    {
        $rates = array();
        Log::info($packageIds);
        foreach ($packageIds as $id) {
            $package = $this->packageRepository->findById($id);

            $addressFrom = array(
                'name' => $package->companyWarehouse->name,
                'street1' => $package->companyWarehouse->address->street,
                'city' => $package->companyWarehouse->address->city,
                'state' => $package->companyWarehouse->address->state,
                'zip' => $package->companyWarehouse->address->postal_code,
                'country' => $package->companyWarehouse->address->country,
                'phone' => $package->companyWarehouse->phones()->first()->number,
                'email' => 'holyship@gmail.com'
            );

            if(is_null($address)) {
               $address = $package->client->defaultAddress;
            }
            $addressTo = array(
                'name' => $address->owner_name . ' ' . $address->owner_surname,
                'street1' => $address->street,
                'city' => $address->city,
                'state' => $address->state,
                'zip' => $address->postal_code,
                'country' => $address->country,
                'phone' => $package->client->phones()->first()->number,
                'email' => $package->client->user->email
            );

            $items = array();

            foreach ($package->goodsDeclaration as $goods) {
                $item = array(
                    "description" => $goods->description,
                    "quantity" => $goods->quantity,
                    "value_amount" => $goods->total_unit,
                    "value_currency" => "USD",
                    "metadata" => "Customs Item",
                    "origin_country" => $package->companyWarehouse->address->country
                );
                array_push($items, $item);
            }

            $custom_declaration = array(
                "contents_type" => $package->content_type ? "MERCHANDISE" : 'GIFT',
                "contents_explanation" => $package->description,
                "non_delivery_option" => "RETURN",
                "certify" => true,
                "certify_signer" => "Holyship",
                "items" => $items,
                "metadata" => "Custom declarations"
            );



            $parcel = array(
                "length" => $package->depth,
                "width" => $package->width,
                "height" => $package->height,
                "distance_unit" => $package->unit_measure,
                "weight" => $package->weight,
                "mass_unit" => $package->weight_measure
            );

            $shipment = Shippo_Shipment::create(array(
                'address_to' => $addressTo,
                'address_from' => $addressFrom,
                'async' => false,
                'parcels' => $parcel
            ))->rates;
            
            array_push($rates, $shipment);
        }

        return $rates;

    }


}
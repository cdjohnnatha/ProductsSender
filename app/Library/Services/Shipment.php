<?php

namespace App\Library\Services;

use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\Log;
use Shippo_Address;
use Shippo_CustomsDeclaration;
use Shippo_Shipment;
use Shippo_Transaction;

class Shipment
{
    public function getRates($packages, $address)
    {
        $rates = array();
        foreach ($packages as $package) {
            $addressFrom = $this->validateAddress(
                $package->companyWarehouse->name,
                $package->companyWarehouse->address,
                $package->companyWarehouse->phones()->first()->number,
                'holyship@gmail.com',
                $package->companyWarehouse->company->name
                );

            if(!$addressFrom) {
                return null;
            }

            if(is_null($address)) {
               $address = $package->client->defaultAddress;
            }
            $fullname = $address->owner_name . ' ' . $address->owner_surname;
            $addressTo = $this->validateAddress(
                $fullname,
                $address,
                $package->client->phones()->first()->number,
                $package->client->user->email,
                $address->company_name);
            if(!$addressTo) {
                return null;
            }

            $custom_item = array();

            foreach ($package->goodsDeclaration as $goods) {
                $item =
                    array(
                        'description'=> $goods->description,
                        'quantity'=> $goods->quantity,
                        'net_weight'=> $goods->net_weight,
                        'mass_unit'=> $goods->mass_unit,
                        'value_amount'=> $goods->total_unit,
                        'value_currency'=> 'USD',
                        'origin_country'=> $package->companyWarehouse->address->country
                );
                array_push($custom_item, $item);
            }


            $custom_declaration = Shippo_CustomsDeclaration::create(
                array(
                    "contents_type" => $package->content_type ? "MERCHANDISE" : 'GIFT',
                    "contents_explanation" => $package->description,
                    "non_delivery_option" => "RETURN",
                    "certify" => true,
                    "certify_signer" => "Holyship",
                    "items" => $custom_item
                )
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
                'parcels' => $parcel,
                'customs_declaration' => $custom_declaration->object_id
            ))->rates;
            
            array_push($rates, $shipment);
        }

        return $rates;

    }

    public function createTransaction($orderFoward)
    {

        $transaction = Shippo_Transaction::create( array(
            'rate' => $orderFoward->goshippo_object_id,
            'label_file_type' => "PDF",
            'async' => false ) );

        return $transaction;
    }

    public function validateAddress($name, $address, $phone, $email, $companyName)
    {
        $validAddress = Shippo_Address::create( array(
            "name" => $name,
            "phone" => $phone ,
            "email" => $email,
            "company" => $companyName,
            "street1" => $address->street,
            "street2" => $address->street2,
            "city" => $address->city,
            "state" => $address->state ,
            "zip" => $address->postal_code ,
            "country" => $address->country ,
            "street_no" => $address->number,
            "validate" => true
        ));

        if($validAddress->is_complete) {
            return $validAddress;
        } else {
            return false;
        }
    }


}
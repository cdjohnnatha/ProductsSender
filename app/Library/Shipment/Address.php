<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/7/17
 * Time: 1:15 AM
 */
namespace App\Library\Shipment;
class Address
{
    private $address;

    function __construct($address)
    {
        $this->address = array(
            'name' => $address->owner_name . ' ' . $address->owner_surname ,
            'street1' => $address->street,
            'city' => $address->city,
            'state' => $address->state,
            'zip' => $address->postal_code,
            'country' => $address->country,
            'phone' => $address->phone,
            'email' => 'cdjohnnatha@gmail.com'
        );
    }

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($address)
    {
        $this->address = $address;
    }
}
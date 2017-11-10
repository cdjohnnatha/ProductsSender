<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/7/17
 * Time: 1:31 AM
 */

namespace App\Library\Shipment;


class Parcels
{
    private $parcel;

    function __construct($packages)
    {
      $this->parcel  = array(
        "length" => $packages->depth,
        "width" => $packages->width,
        "height" => $packages->height,
        "distance_unit" => $packages->unit_measure,
        "weight" => $packages->weight,
        "mass_unit" => $packages->weight_measure
      );
    }

    function getParcel()
    {
        return $this->parcel;
    }

    function setParcel($parcel)
    {
        return $this->parcel = $parcel;
    }
}
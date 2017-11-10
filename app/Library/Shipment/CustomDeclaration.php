<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/7/17
 * Time: 5:10 PM
 */

namespace App\Library\Shipment;


class CustomDeclaration
{
    private $custom_declarance;

    function __construct($goods, $items)
    {
        $this->custom_declaration = array(
            "contents_type" => $goods->content_type ? "MERCHANDISE" : 'GIFT',
            "contents_explanation" => $goods->description,
            "non_delivery_option" => "RETURN",
            "certify" => true,
            "certify_signer" => "Holyship",
            "items" => $items->getItems(),
            "metadata" => "Custom declarations"
        );
    }

    function getCustomDeclaration()
    {
        return $this->custom_declaration;
    }

    function setCustomDeclaration($custom_declaration)
    {
        $this->custom_declaration = $custom_declaration;
    }
}
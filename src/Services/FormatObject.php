<?php

namespace App\Services;

Class FormatObject
{
    public function constructDistanceObject($value)
    {
        print_r($value);
        $object = array();
        $object['address_id'] = $value->getId();
        $object['address_ip'] = $value->getAddressIp();
        $object['address_postal'] = $this->formatAddress($value);
        $object['distance'] = $value->getDistanceResult();

        return $object;
    }

    public function formatAddress($object)
    {
        $addressNumber = $object->getAddressNumber();
        $addressStreet = $object->getAddressStreet();
        $addressPostalCode = $object->getAddressPostalCode();
        $addressCity = $object->getAddressCity();
        $addressCountry = $object->getAddressCountry();
        $postalAddress = $addressNumber.' '.$addressStreet.', '.$addressPostalCode.' '.$addressCity.' '.$addressCountry;

        return $postalAddress;
    }
}
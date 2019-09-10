<?php


namespace App\Services;

use App\Geolocation\ApiDistance;
use App\Services\FormatObject;
use App\Geolocation\ApiMapQuest;
use App\Geolocation\ApiGeoIpfy;
use Symfony\Component\HttpClient\HttpClient;

class CalculateDistance
{
    public function calculateDistance($data)
    {
        // convert address to geolocation point
        $formatObject = new FormatObject();
        $address = $formatObject->formatAddress($data);
        $addressLatLng = $this->getLatLngForAddress($address);
        $ipLatLng = $this->getLatLngForIpAddress($data->getAddressIp());

        // call api get distance between geolocation points
        $from = $addressLatLng['lat'].';'.$addressLatLng['lng'];
        $to = $ipLatLng['lat'].';'.$ipLatLng['lng'];

        $localApi = new ApiDistance();
        $result = $localApi->CallApi($from, $to);
        return $result;
    }

    private function getLatLngForIpAddress($ip)
    {
        $httpClient = new HttpClient();
        $apiClient = new ApiGeoIpfy($httpClient);
        $result = $apiClient->CallApi($ip);
        if (array_key_exists('location', $result)) {
            return array(
                "lat" => $result['location']['lat'],
                "lng" => $result['location']['lng'],
            );
        }

        return false;
    }

    private function getLatLngForAddress($address)
    {
        $httpClient = new HttpClient();
        $apiClient = new ApiMapQuest($httpClient);
        // get lat/lng for address
        $getLocation = $apiClient->CallApi($address);
        if (array_key_exists('results', $getLocation) && count($getLocation['results']) > 0) {
            $arrayResult = $getLocation['results'][0];
            if (array_key_exists('locations', $arrayResult) && count($arrayResult['locations']) > 0
                && array_key_exists('latLng', $arrayResult['locations'][0])) {
                return $arrayResult['locations'][0]['latLng'];
            }
        }

        return false;
    }
}
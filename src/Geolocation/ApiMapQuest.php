<?php

namespace App\Geolocation;

use Symfony\Component\HttpClient\HttpClient;

class ApiMapQuest
{
    const API_URL = 'https://www.mapquestapi.com/geocoding/v1/address';
    // @todo change this declaration (personnel api key)
    const API_KEY = 'xo8ukTocDKJiB66lCv0sgUPP5UhNt4yC';

    public function CallApi($from)
    {
        $response = $this->buildHttpRequest($from);
        if (200 !== $response->getStatusCode()) {
            return [];
        } else {
            $content = $response->getContent();
        }

        return json_decode($content, true);
    }

    private function buildHttpRequest($from)
    {
        $httpClient = HttpClient::create();
        $request = $httpClient->request(
            'GET',
            self::API_URL,
            [
                'query' => [
                    "key" => self::API_KEY,
                    "inFormat" => "kvp",
                    "outFormat" => "json",
                    "location" => $from,
                    "thumbMaps" => 'false'
                ]
            ]
        );

        return $request;
    }
}
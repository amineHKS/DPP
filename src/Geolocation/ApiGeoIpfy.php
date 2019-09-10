<?php

namespace App\Geolocation;

use Symfony\Component\HttpClient\HttpClient;

class ApiGeoIpfy
{
    const API_URL = 'https://geo.ipify.org/api/v1';
    // @todo change this declaration (personnel api key)
    const API_KEY = 'at_32SAEquGAFzM2OcX9S7ZehNW7R99j';

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

    private function buildHttpRequest($ip)
    {
        $httpClient = HttpClient::create();
        $request = $httpClient->request(
            'GET',
            self::API_URL,
            [
                'query' => [
                    "apiKey" => self::API_KEY,
                    "ipAddress" => $ip
                ]
            ]
        );

        return $request;
    }
}
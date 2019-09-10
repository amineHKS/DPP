<?php

namespace App\Geolocation;

use Symfony\Component\HttpClient\HttpClient;

class ApiDistance
{
    const API_URL = 'http://127.0.0.1:8088/api/distance/';

    public function CallApi($from, $to)
    {
        $response = $this->buildHttpRequest($from, $to);
        if (200 !== $response->getStatusCode()) {
            return [];
        } else {
            $content = $response->getContent();
        }

        return json_decode($content, true);
    }

    private function buildHttpRequest($from, $to)
    {
        $httpClient = HttpClient::create();
        $request = $httpClient->request(
            'GET',
            self::API_URL.$from.'/'.$to
        );

        return $request;
    }
}
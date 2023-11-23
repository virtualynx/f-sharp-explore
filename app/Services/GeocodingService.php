<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodingService
{
    private string $base_uri;

    public function __construct(){
        $this->base_uri = config('api.base_uri.geocoding');
    }

    private function reverseGeocode(float $lat, float $long){
        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $response = $client->request(
            'GET', 
            'data/reverse-geocode-client?latitude='.$lat.'&longitude='.$long
        );

        if($response->getStatusCode() == 200){
            $responseJson = json_decode($response->getBody()->getContents(), true);

            return [
                'countryName' => $responseJson['countryName'],
                'principalSubdivision' => $responseJson['principalSubdivision'],
                'city' => $responseJson['city'],
            ];
        }else{
            throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
        }
    }
}
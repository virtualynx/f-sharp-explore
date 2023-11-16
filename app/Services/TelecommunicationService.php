<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use GuzzleHttp\HandlerStack;

class TelecommunicationService
{
    private string $base_uri;

    public function __construct()
    {
        $this->base_uri = config('api.base_uri.msisdn_track');
    }

    private function generateHeader()
    {
        $api_key = config('api.key.msisdn_track');

        return [
            'User-Agent' => 'insomnia/8.3.0',
            'auth_key' => $api_key
        ];
    }

    public function getMsisdnsPosition(string $msisdn)
    {
        $uri = config('api.uri.msisdn_track');

        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);

        $response = $client->request('GET', $uri . '/' . $msisdn);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status']) && $resp_arr['status'] == 1 && $resp_arr['statusCode'] == 200) {
                $resp_respon = $resp_arr['respon'][0];
                $data = [
                    'msisdn' => $msisdn,
                    'imsi' => $resp_respon['imsi'],
                    'imei' => $resp_respon['imei'],
                    'provider' => $resp_respon['net_provider'],
                    'address' => $resp_respon['address'],
                    'phone' => $resp_respon['phone'],
                    'lat' => (float)$resp_respon['latitude'],
                    'long' => (float)$resp_respon['longitude']
                ];

                return $data;
            } else if (isset($resp_arr['res'])) {
                if ($resp_arr['res'] == 'success') {
                    throw new Exception($resp_arr['msg'], 1);
                } else if ($resp_arr['res'] == 'failed') {
                    throw new Exception($resp_arr['msg'], 2);
                }
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    
}

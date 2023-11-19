<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use kamermans\OAuth2\Persistence\FileTokenPersistence;
use GuzzleHttp\HandlerStack;

class DataLeakService extends _GeneralService
{
    private OAuth2Middleware $oauth_middleware;
    public function __construct()
    {
        parent::__construct();
    }

    private function getClient()
    {
        $stack = HandlerStack::create();

        $client = new Client([
            'auth-key' => '97ebd8b107af40fe7cd2e63b2abe42413ad43e3f',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        return $client;
    }

    private function encodeRequestPayload(array $payload)
    {
        return json_encode(
            [
                'ehlo' => base64_encode(json_encode($payload))
            ]
        );
    }

    public function getDataLeak(string $msisdn)
    {
        $uri = config('api.uri.general.data_leak');

        $response = $this->getHttpClient()->request('GET', $uri . '/' . $msisdn);

        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);

            if (isset($resp_arr['status'])) {
                if ($resp_arr['status'] == "data_ok") {

                    return $resp_arr['person_data'];
                } else if ($resp_arr['status'] == "diterima") {
                    return [];
                }
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getGmailLeak(string $gmail)
    {
        $uri = config('api.uri.general.gmail_password');

        $response = $this->getHttpClient()->request('GET', $uri . '/' . $gmail);

        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);

            if (isset($resp_arr['Gmail_Leaks'])) {
                return $resp_arr['Gmail_Leaks'];
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getSosmedLeak(string $sosmed)
    {
        $client = new Client();

        $url = 'http://202.43.190.20:8088/osint/search/';

        $headers = [
            'auth-key' => '97ebd8b107af40fe7cd2e63b2abe42413ad43e3f',
            'Content-Type' => 'application/json',
            // Add any other headers as needed
        ];

        $data = [
            'username' => $sosmed,
            'total_sites' => "10"
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);
        // $response = $this->getHttpClientPost()->request(
        //     'POST',
        //     $uri,
        //     ['body' => json_encode($payload)]
        // );

        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);

            if (isset($resp_arr)) {
                return $resp_arr;
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }
}

<?php

namespace App\Services;

use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use GuzzleHttp\HandlerStack;

class SiliwangiService
{
    private string $url_kujang;

    public function __construct(){
        $this->url_kujang = config('api.base_uri.kujang').'/'.config('api.uri.kujang');
    }

    private function getClient(){
        $base_uri = config('api.oauth.url');
        $username = config('api.oauth.username');
        $password = config('api.oauth.password');

        $reauth_client = new Client([
            'base_uri' => $base_uri,
        ]);
        $reauth_config = [
            "client_id" => "",
            "client_secret" => "",   
            "username" => $username, 
            "password" => $password, 
            "grant_type" => "password", 
        ];
        $grant_type = new PasswordCredentials($reauth_client, $reauth_config);
        $oauth = new OAuth2Middleware($grant_type);

        $stack = HandlerStack::create();
        $stack->push($oauth);
        
        $client = new Client([
            'handler' => $stack,
            'auth' => 'oauth',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        return $client;
    }

    private function encodeRequestPayload(array $payload){
        return json_encode(
            [
                'ehlo' => base64_encode(json_encode($payload))
            ]
        );
    }

    public function getIdDataByNik(string $nik){
        $payload = [
            'ask_for' => 'id_data',
            'wtk' => $nik
        ];

        $response = $this->getClient()->request('POST', $this->url_kujang, 
            [
                // 'body' => json_encode(
                //     [
                //         'ehlo' => 'eyJ3dGsiOiAiMzIxNjA2MDQxMjc3MDAxNCIsICJhc2tfZm9yIjogImlkX2RhdGEifQ=='
                //     ]
                // )
                'body' => $this->encodeRequestPayload($payload)
            ]
        );

        if($response->getStatusCode() == 200){
            $bodyContents = $response->getBody()->getContents();
            return $bodyContents;
        }else{
            throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
        }
    }
}
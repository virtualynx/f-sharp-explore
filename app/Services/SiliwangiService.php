<?php

namespace App\Services;

use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use GuzzleHttp\HandlerStack;

class SiliwangiService
{
    private function generateOauthHandler(){
        $base_uri = config('api.oauth.url');
        $username = config('api.oauth.username');
        $password = config('api.oauth.password');

        $reauth_client = new Client([
            // URL for access_token request
            'base_uri' => $base_uri,
        ]);
        $reauth_config = [
            // "client_id" => "***",
            // "client_secret" => "***",   
            "client_id" => "",
            "client_secret" => "",   
            "username" => $username, 
            "password" => $password, 
            "grant_type" => "password", 
        ];
        $grant_type = new PasswordCredentials($reauth_client, $reauth_config);
        $oauth = new OAuth2Middleware($grant_type);

        return $oauth;
    }

    public function getKtpData(){
        $stack = HandlerStack::create();
        $stack->push($this->generateOauthHandler());

        // This is the normal Guzzle client that you use in your application
        $client = new Client([
            'handler' => $stack,
            'auth' => 'oauth',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        // $response = $client->get('https://***/api/v1_2/agendas');
        $response = $client->request('POST', 'https://api.siliwangi.cloud/kujang', 
            [
                'body' => json_encode(
                    [
                        'ehlo' => 'eyJ3dGsiOiAiMzIxNjA2MDQxMjc3MDAxNCIsICJhc2tfZm9yIjogImlkX2RhdGEifQ=='
                    ]
                )   
            ]
        );

        $bodyContents = $response->getBody()->getContents();

        echo "Status: ".$response->getStatusCode()."\n";
    }
}
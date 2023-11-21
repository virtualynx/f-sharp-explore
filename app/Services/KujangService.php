<?php

namespace App\Services;

use App\Enums\KujangAskforEnum;
use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use kamermans\OAuth2\Persistence\FileTokenPersistence;
use GuzzleHttp\HandlerStack;

class KujangService
{
    private string $url_kujang;
    private OAuth2Middleware $oauth_middleware;

    public function __construct(){
        $this->url_kujang = config('api.base_uri.kujang').config('api.uri.kujang');
        $this->oauth_middleware = $this->generateOauthMiddleware(true);
    }

    private function getClient(){
        $stack = HandlerStack::create();
        $stack->push($this->oauth_middleware);
        
        $client = new Client([
            'handler' => $stack,
            'auth' => 'oauth',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        return $client;
    }

    private function generateOauthMiddleware(bool $persistToken = false): OAuth2Middleware{
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

        if($persistToken){
            $token_path = 'tmp/kujang_token.json';
            $token_persistence = new FileTokenPersistence($token_path);
    
            $oauth->setTokenPersistence($token_persistence);
        }

        return $oauth;
    }

    private function encodeRequestPayload(array $payload){
        return json_encode(
            [
                'ehlo' => base64_encode(json_encode($payload))
            ]
        );
    }

    public function ask(string $wtk, KujangAskforEnum $ask_for){
        $payload = [
            'ask_for' => $ask_for->value,
            'wtk' => $wtk
        ];

        $response = $this->getClient()->request(
            'POST', 
            $this->url_kujang, 
            ['body' => $this->encodeRequestPayload($payload)]
        );

        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents(), true);

            return $result;
        }else{
            throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
        }
    }

    public function askForNik(string $nik){
        $payload = [
            'ask_for' => 'nik',
            'wtk' => $nik
        ];

        $response = $this->getClient()->request(
            'POST', 
            $this->url_kujang, 
            ['body' => $this->encodeRequestPayload($payload)]
        );

        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents(), true);

            return $result;
        }else{
            throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
        }
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
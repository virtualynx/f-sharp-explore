<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use GuzzleHttp\HandlerStack;

class TransportasiService
{
    private string $base_uri;

    public function __construct(){
        $this->base_uri = config('api.base_uri.general');
    }

    private function generateHeader(){
        $api_key = config('api.key.general');

        return [
            // 'User-Agent' => 'insomnia/8.3.0',
            'auth_key' => $api_key
        ];
    }

    public function getVehicleNumber(string $nopol, string $type){
        $uri = config('api.uri.general.kendaraan_track');

        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);

        $response = $client->request('GET', $uri.'/'.$type.'/'.$nopol);
       
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
           
            if(isset($resp_arr['status']) && $resp_arr['status']=="data_ok"){
                if($resp_arr['status']=="data_ok"){
                    if($type === 'nopol'){
                        return [$resp_arr['vehicle']];
                    }else if($type === 'nik'){
                        return $resp_arr['vehicle'];
                    }
                }else if($resp_arr['status']=="data_tidak_ada"){
                    return [];
                }
            }else{
                throw new Exception("Unknown Error", 99);
            }
        }else{
            throw new Exception($response->getReasonPhrase().'('.$response->getStatusCode().')', 99);
        }
    }
}
<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GoapiService implements WilayahService
{
    private string $base_uri;
    private string $api_key;
    private string $uri = 'regional';

    public function __construct()
    {
        $this->base_uri = config('api.base_uri.goapi');
        $this->api_key = config('api.key.goapi');
    }

    private function getHttpClient(){
        return new Client([
            'base_uri' => $this->base_uri,
            'headers' => [
                'X-API-KEY' => $this->api_key,
                'accept' => 'application/json'
            ]
        ]);
    }

    public function getAllProvince()
    {
        $response = $this->getHttpClient()->request('GET', $this->uri.'/provinsi');
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status']) && $resp_arr['status'] == 'success') {
                $data = $resp_arr['data'];
                return $data;
            } else {
                Log::error(json_encode($resp_arr));
                throw new Exception(json_encode($resp_arr), 99);
            }
        } else {
            Log::error($response->getReasonPhrase());
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getCitiesByProvince(string $province_id)
    {
        $response = $this->getHttpClient()->request('GET', $this->uri.'/kota?provinsi_id='.$province_id);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status']) && $resp_arr['status'] == 'success') {
                $data = $resp_arr['data'];
                return $data;
            } else {
                Log::error(json_encode($resp_arr));
                throw new Exception(json_encode($resp_arr), 99);
            }
        } else {
            Log::error($response->getReasonPhrase());
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }
}

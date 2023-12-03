<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BinderbyteService implements WilayahService
{
    private string $base_uri;
    private string $api_key;

    public function __construct()
    {
        $this->base_uri = config('api.base_uri.binderbyte');
        $this->api_key = config('api.key.binderbyte');
    }

    private function getHttpClient(){
        return new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function getAllProvince()
    {
        $response = $this->getHttpClient()->request('GET', 'wilayah/provinsi?api_key=' . $this->api_key);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['code']) && $resp_arr['code'] == '200') {
                $value = $resp_arr['value'];

                return $value;
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
        $response = $this->getHttpClient()->request('GET', 'wilayah/kabupaten?api_key='.$this->api_key.'&id_provinsi='.$province_id);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['code']) && $resp_arr['code'] == '200') {
                $value = $resp_arr['value'];

                return $value;
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

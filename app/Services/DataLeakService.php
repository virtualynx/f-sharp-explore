<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DataLeakService extends _GeneralService
{
    public function __construct()
    {
        parent::__construct();
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

        $response = null;
        try{
            $response = $this->getHttpClient()->request('GET', $uri . '/' . $gmail);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            $msg = $e->getMessage();
            if($e->getCode() == 422){
                if(str_contains($msg, 'value is not a valid email address')) {
                    throw new Exception("Is not a valid email address", 1);
                }
            }else if($e->getCode() == 404){
                if(str_contains($msg, 'Alamat email tidak ditemukan.')) {
                    throw new Exception("Alamat email tidak ditemukan", 1);
                }
                throw new Exception("Is not a valid email address", 1);
            }else{
                throw new Exception($e->getMessage(), 99);
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
            throw new Exception("Unknown Error", 99);
        }

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
        $data = [
            'username' => $sosmed,
            'total_sites' => "10"
        ];

        try{
            $response = $this->getHttpClient()->post('osint/search/', ['json' => $data]);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            $msg = $e->getMessage();
            if($e->getCode() == 400){
                if(str_contains($msg, 'Format input tidak valid.')) {
                    throw new Exception("Format input tidak valid", 1);
                }
            }else{
                throw new Exception($e->getMessage(), 99);
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
            throw new Exception("Unknown Error", 99);
        }
        
        if($response->getStatusCode() == 200) {
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

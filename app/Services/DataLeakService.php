<?php

namespace App\Services;

use Exception;

class DataLeakService extends _GeneralService
{
    public function __construct(){
        parent::__construct();
    }

    public function getDataLeak(string $msisdn){
        $uri = config('api.uri.general.data_leak');

        $response = $this->getHttpClient()->request('GET', $uri.'/'.$msisdn);
       
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
           
            if(isset($resp_arr['status'])){
                if($resp_arr['status']=="data_ok"){
                    
                        return $resp_arr['person_data'];
                }else if($resp_arr['status']=="diterima"){
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
<?php

namespace App\Services;

use Exception;

class TransportasiService extends _GeneralService
{
    public function __construct(){
        parent::__construct();
    }

    public function getVehicleNumber(string $nopol, string $type){
        $uri = config('api.uri.general.kendaraan_track');

        $response = $this->getHttpClient()->request('GET', $uri.'/'.$type.'/'.$nopol);
       
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
           
            if(isset($resp_arr['status'])){
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
<?php

namespace App\Services;

use Exception;

class TelecommunicationService extends _GeneralService
{
    public function __construct(){
        parent::__construct();
    }

    public function locateMsisdn(string $msisdn){
        $uri = config('api.uri.general.msisdn_track');

        $response = $this->getHttpClient()->request('GET', $uri.'/'.$msisdn);
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
            if(isset($resp_arr['status']) && $resp_arr['status']==1 && $resp_arr['statusCode']==200){
                $resp_respon = $resp_arr['respon'][0];
                $data = [
                    'msisdn' => $msisdn,
                    'imsi' => $resp_respon['imsi'],
                    'imei' => $resp_respon['imei'],
                    'provider' => $resp_respon['net_provider'],
                    'address' => $resp_respon['address'],
                    'phone' => $resp_respon['phone'],
                    'lat' => (float)$resp_respon['latitude'],
                    'long' => (float)$resp_respon['longitude']
                ];

                return $data;
            }else if(isset($resp_arr['res'])){
                if($resp_arr['res'] == 'success'){
                    throw new Exception($resp_arr['msg'], 1);
                }else if($resp_arr['res'] == 'failed'){
                    throw new Exception($resp_arr['msg'], 2);
                }
            }else{
                throw new Exception("Unknown Error", 99);
            }
        }else{
            throw new Exception($response->getReasonPhrase().'('.$response->getStatusCode().')', 99);
        }
    }
}
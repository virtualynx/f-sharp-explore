<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use GuzzleHttp\Client;

class TransportasiApi extends Controller{

    public function cek_kendaraan(Request $request)
    {
        $payloadRequest = $request->all();
        $msisdns = $payloadRequest['msisdns'];

        $base_uri = config('api.base_uri.msisdn_track');
        $uri = config('api.uri.msisdn_track');
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $base_uri,
            // You can set any number of default request options.
            // 'timeout'  => 2.0,
            'headers' => $this->getInsomniaHeader()
        ]);

        try{
            $datas = array();
            foreach($msisdns as $msisdn){
                $response = $client->request('GET', $uri.'/'.$msisdn);
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

                        array_push($datas, $data);
                    }else if(isset($resp_arr['res'])){
                        if($resp_arr['res'] == 'success'){
                            return new ApiResponse(null, 1, $resp_arr['msg']."(msisdn: ".$msisdn.")");
                        }else if($resp_arr['res'] == 'failed'){
                            return new ApiResponse(null, 99, $resp_arr['msg']."(msisdn: ".$msisdn.")");
                        }
                    }else{
                        return new ApiResponse(null, $response->getStatusCode(), "Unknown Error");
                    }
                }
            }
    
            return new ApiResponse($datas);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
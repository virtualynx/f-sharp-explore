<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use GuzzleHttp\Client;

class TelecommunicationApi extends Controller{

    public function tracking_msisdn(string $msisdn)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('api.endpoint.msisdn_track'),
            // You can set any number of default request options.
            // 'timeout'  => 2.0,
            'headers' => [
                'User-Agent' => 'insomnia/8.3.0',
                'auth_key' => config('api.key.msisdn_track')
            ]
        ]);

        try{
            $response = $client->request('GET', '/cekpos/'.$msisdn);
            if($response->getStatusCode() == 200){
                $resp_arr = json_decode($response->getBody(), true);
                if($resp_arr['status']==1 && $resp_arr['statusCode']==200){
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

                    return new ApiResponse($data);
                }else{
                    return new ApiResponse(null, $resp_arr['status'], $resp_arr['message']);
                }
            }
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
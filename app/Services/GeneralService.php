<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use GuzzleHttp\HandlerStack;

class GeneralService
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

    public function locateMsisdn(string $msisdn){
        $uri = config('api.uri.general.msisdn_track');

        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);

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
    
    public function getKtpDataByNik(string $nik){
        $uri = config('api.uri.general.ktp_data');

        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);

        $response = $client->request('GET', $uri.'/nik/'.$nik);
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
            if(isset($resp_arr['status'])){
                if($resp_arr['status']=='data_ok'){
                    return $resp_arr['id_data'];
                }else{
                    throw new Exception($resp_arr['status'], 1);
                }
            }else{
                throw new Exception(json_encode($resp_arr), 99);
            }
        }else{
            throw new Exception($response->getReasonPhrase().'('.$response->getStatusCode().')', 99);
        }
    }

    public function getKtpDataByNkk(string $nkk){
        $datas = [];
        $uri = config('api.uri.general.ktp_data');

        $client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);

        $response = $client->request('GET', $uri.'/nkk/'.$nkk);
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
            if(isset($resp_arr['status'])){
                if($resp_arr['status']=='data_ok'){
                    $responCount = count($resp_arr['family_data']);
                    if ($responCount > 0){
                        $respons = $resp_arr['family_data'];
                        foreach($respons as $respon){
                            $datas[] = [
                                "kode_pos" => $respon["KODE_POS"],
                                "tgl_lhr" => $respon["TGL_LHR"],
                                "tmpt_lhr" => $respon["TMPT_LHR"],
                                "foto" => base64_decode($respon["FOTO"])
                            ];
                        }
                    }

                    return $resp_arr['family_data'];
                }else{
                    throw new Exception($resp_arr['status'], 1);
                }
            }else{
                throw new Exception(json_encode($resp_arr), 99);
            }
        }else{
            throw new Exception($response->getReasonPhrase().'('.$response->getStatusCode().')', 99);
        }
    }
}
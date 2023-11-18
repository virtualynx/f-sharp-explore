<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class KtpService extends _GeneralService
{
    private SearchLogService $logService;

    public function __construct(SearchLogService $logService)
    {
        parent::__construct();
        $this->logService = $logService;
    }

    public function getKtpDataByNik(string $nik)
    {
        $uri = config('api.uri.general.ktp_data');

        $response = $this->getHttpClient()->request('GET', $uri . '/nik/' . $nik);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status'])) {
                if ($resp_arr['status'] == 'data_ok') {
                    $id_data = $resp_arr['id_data'];
                    $this->logService->dukcapil($id_data);

                    return $resp_arr['id_data'];
                } else {
                    Log::error($resp_arr['status']);
                    throw new Exception($resp_arr['status'], 1);
                }
            } else {
                Log::error(json_encode($resp_arr));
                throw new Exception(json_encode($resp_arr), 99);
            }
        } else {
            Log::error($response->getReasonPhrase());
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getKtpDataByNkk(string $nkk)
    {
        $datas = [];
        $uri = config('api.uri.general.ktp_data');

        $response = $this->getHttpClient()->request('GET', $uri . '/nkk/' . $nkk);
        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status'])) {
                if ($resp_arr['status'] == 'data_ok') {
                    $responCount = count($resp_arr['family_data']);
                    if ($responCount > 0) {
                        $respons = $resp_arr['family_data'];
                        foreach ($respons as $respon) {
                            $this->logService->dukcapil($respon);

                            $datas[] = [
                                "kode_pos" => isset($respon["KODE_POS"]) ? $respon["KODE_POS"] : null,
                                "tgl_lhr" => isset($respon["TGL_LHR"]) ? $respon["TGL_LHR"] : null,
                                "tmpt_lhr" => isset($respon["TMPT_LHR"]) ? $respon["TMPT_LHR"] : null,
                                "foto" => isset($respon["FOTO"]) ? base64_decode($respon["FOTO"]) : null
                            ];
                        }
                    }

                    return $resp_arr['family_data'];
                } else {
                    throw new Exception($resp_arr['status'], 1);
                }
            } else {
                throw new Exception(json_encode($resp_arr), 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getKarakter($dob, string $type)
    {
        $uri = config('api.uri.general.karakter');
        $countDob = count($dob);
        $dataArrDob = [];
        for ($i = 0; $i < $countDob; $i++) {
            $response = $this->getHttpClient()->request('GET', $uri . '/' . $dob[$i]);
            if ($response->getStatusCode() == 200) {
                $resp_arr = json_decode($response->getBody(), true);
                if (isset($resp_arr['Zodiak'])) {
                    $dataArrDob[] = [$resp_arr];
                    
                } else {
                    Log::error(json_encode($resp_arr));
                    throw new Exception(json_encode($resp_arr), 99);
                }
            } else {
                Log::error($response->getReasonPhrase());
                throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
            }
           
        }
        return $dataArrDob;
    }
}

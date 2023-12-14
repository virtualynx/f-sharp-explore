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

                    $id_data['NAMA_LGKP'] = ucwords($id_data['NAMA_LGKP']);

                    return $id_data;
                } else {
                    Log::error($resp_arr['status']);
                    $status = $resp_arr['status'];
                    if ($status == 'diterima') {
                        $status = 'Api dukcapil belum dapat merespon, harap coba kembali nanti';
                    }
                    throw new Exception($status, 1);
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
                        $dataArr = [];
                        $respons = $resp_arr['family_data'];
                        foreach ($respons as $respon) {
                            $responseDetailFoto = $this->getHttpClient()->request('GET', $uri . '/nik/' . $respon['NIK']);
                            if ($responseDetailFoto->getStatusCode() == 200) {
                                $resp_arr_foto = json_decode($responseDetailFoto->getBody(), true);
                                if (isset($resp_arr_foto['status'])) {
                                    if ($resp_arr_foto['status'] == 'data_ok') {
                                        $fotoNIK = $resp_arr_foto['id_data']['FOTO'];
                                    }
                                }
                            }
                            $this->logService->dukcapil($respon);

                            $dataArr[] = [
                                "TMPT_LHR" => $respon["TMPT_LHR"],
                                "AGAMA" => $respon["TMPT_LHR"],
                                "GOL_DARAH" => $respon["GOL_DARAH"],
                                "JENIS_KLMIN" => $respon["JENIS_KLMIN"],
                                "JENIS_PKRJN" => $respon["JENIS_PKRJN"],
                                "KODE_POS" => $respon["KODE_POS"],
                                "NAMA_LGKP" => $respon["NAMA_LGKP"],
                                "NAMA_LGKP_AYAH" => $respon["NAMA_LGKP_AYAH"],
                                "NAMA_LGKP_IBU" => $respon["NAMA_LGKP_IBU"],
                                "NIK" => $respon["NIK"],
                                "NKK" => $respon["NKK"],
                                "NO_RT" => $respon["NO_RT"],
                                "NO_RW" => $respon["NO_RW"],
                                "PDDK_AKH" => $respon["PDDK_AKH"],
                                "STAT_HBKEL" => $respon["STAT_HBKEL"],
                                "STAT_KWN" => $respon["STAT_KWN"],
                                "TGL_LHR" => $respon["TGL_LHR"],
                                "FOTO" => $fotoNIK
                            ];
                            $datas[] = [
                                "kode_pos" => isset($respon["KODE_POS"]) ? $respon["KODE_POS"] : null,
                                "tgl_lhr" => isset($respon["TGL_LHR"]) ? $respon["TGL_LHR"] : null,
                                "tmpt_lhr" => isset($respon["TMPT_LHR"]) ? $respon["TMPT_LHR"] : null,
                                "foto" => isset($respon["FOTO"]) ? base64_decode($respon["FOTO"]) : null
                            ];
                        }
                    }



                    return $dataArr;
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

<?php

namespace App\Http\Controllers\Api;

use App\Enums\KujangAskforEnum;
use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use App\Services\KtpService;
use Exception;

class EKtpApi extends _Controller{
    private KtpService $service;

    public function __construct(KtpService $service){
        $this->service = $service;
    }

    public function search_by_nik(Request $request)
    {
        $nik = $request['nik'];

        try{
            // $response = $this->service->ask($nik, KujangAskforEnum::NIK);
            $response = $this->service->getKtpDataByNik($nik);
    
            return new ApiResponse($response);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }

    public function search_by_nkk(Request $request)
    {
        $nkk = $request->nkk;

        try{
            // $response = $this->service->ask($nik, KujangAskforEnum::NIK);
            $response = $this->service->getKtpDataByNkk($nkk);
    
            return new ApiResponse($response);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }

    public function search_by_dob(Request $request)
    {
        $dob = $request->dob;
        $type= $request->type;

        try{
            // $response = $this->service->ask($nik, KujangAskforEnum::NIK);
            $response = $this->service->getKarakter($dob, $type);
    
            return new ApiResponse($response);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }
}
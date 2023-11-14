<?php

namespace App\Http\Controllers\Api;

use App\Enum\KujangAskforEnum;
use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use App\Services\GeneralService;
use Exception;
use App\Services\KujangService;

class EKtpApi extends _Controller{
    private GeneralService $service;

    public function __construct(GeneralService $service){
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
}
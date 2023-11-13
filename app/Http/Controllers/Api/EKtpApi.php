<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use App\Services\KujangService;

class EKtpApi extends _Controller{
    private KujangService $service;

    public function __construct(KujangService $service){
        $this->service = $service;
    }

    public function search_by_nik(Request $request)
    {
        $payloadRequest = $request->all();
        $nik = $request['nik'];

        try{
            $response = $this->service->askForNik($nik);
    
            return new ApiResponse($response);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
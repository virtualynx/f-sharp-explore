<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use App\Services\DataleakService;

class DataLeakApi extends _Controller{
    private DataleakService $service;

    public function __construct(DataleakService $service){
        $this->service = $service;
    }

    public function data_leak(Request $request)
    {
        $msisdn = $request->msisdn;
      
       
        try{
            $response = $this->service->getDataLeak($msisdn);
            
            return new ApiResponse($response);
        }catch(Exception $e){
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }
}
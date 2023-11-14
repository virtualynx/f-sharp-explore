<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use App\Services\TransportasiService;

class TransportasiApi extends _Controller{
    private TransportasiService $service;

    public function __construct(TransportasiService $service){
        $this->service = $service;
    }

    public function tracking_kendaraan(Request $request)
    {
        $payloadRequest = $request->all();
        $nopol = $request->nopol;
        $type = $request->type;
       
        try{
            $response = $this->service->getVehicleNumber($nopol, $type);
            
            return new ApiResponse($response);
        }catch(Exception $e){
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }
}
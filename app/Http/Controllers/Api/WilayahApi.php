<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use App\Services\WilayahService;
use Exception;

class WilayahApi extends _Controller{
    private WilayahService $service;

    public function __construct(WilayahService $service){
        $this->service = $service;
    }

    public function provinces(Request $request)
    {
        try{
            $datas = $this->service->getAllProvince();
    
            return new ApiResponse($datas);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }

    public function cities(string $province_id)
    {
        try{
            $datas = $this->service->getCitiesByProvince($province_id);
    
            return new ApiResponse($datas);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
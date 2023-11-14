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
            $datas = array();
                try{
                    $response = $this->service->getVehicleNumber($nopol, $type);
                    $response['status'] = 'success';
                    array_push($datas, $response);
                }catch(Exception $e){
                    if($e->getCode() == 99){
                        throw $e;
                    }else{
                        //business error
                        $response = [
                            'msisdn' => $nopol,
                            'status' => 'failed',
                            'error' => $e->getMessage()
                        ];
                        array_push($datas, $response);
                    }
                }
            
    
            return new ApiResponse($datas);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
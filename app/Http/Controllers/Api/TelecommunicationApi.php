<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use App\Services\TelecommunicationService;

class TelecommunicationApi extends _Controller{
    private TelecommunicationService $service;

    public function __construct(TelecommunicationService $service){
        $this->service = $service;
    }

    public function locate_msisdn(Request $request)
    {
        $payloadRequest = $request->all();
        $msisdns = $payloadRequest['msisdns'];

        try{
            $datas = array();
            foreach($msisdns as $msisdn){
                try{
                    $response = $this->service->getMsisdnsPosition($msisdn);
                    $response['status'] = 'success';
                    array_push($datas, $response);
                }catch(Exception $e){
                    if($e->getCode() == 99){
                        throw $e;
                    }else{
                        //business error
                        $response = [
                            'msisdn' => $msisdn,
                            'status' => 'failed',
                            'error' => $e->getMessage()
                        ];
                        array_push($datas, $response);
                    }
                }
            }
    
            return new ApiResponse($datas);
        }catch(Exception $e){
            // print_r($e);exit;
            return new ApiResponse(null, 99, $e->getMessage());
        }
    }
}
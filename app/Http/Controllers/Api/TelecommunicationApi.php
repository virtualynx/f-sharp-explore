<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use Exception;
use App\Services\TelecommunicationService;
use Yajra\DataTables\Facades\DataTables;

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
                    $response = $this->service->locateMsisdn($msisdn);
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

    public function get_tracked_list(Request $request){
        $datas = $this->service->getTrackedList();

        return new ApiResponse($datas);
    }

    public function get_tracked_number(Request $request){
        $data = $this->service->getTrackedNumber($request->msisdn);

        return new ApiResponse($data);
    }

    public function save_tracked_number(Request $request){
        if($request->mode == 'add'){
            $this->service->addTrackedNumber($request->all());
        }else if($request->mode == 'edit'){
            $this->service->saveTrackedNumber($request->phone, $request->all());
        }

        return new ApiResponse(null);
    }

    public function delete_tracked_number(Request $request){
        $data = $this->service->deleteTrackedNumber($request->msisdn);

        return new ApiResponse($data);
    }

    public function datatable_tracking_log(string $msisdn){
        $data = $this->service->getTrackingLog($msisdn);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('time', function($row){
                return $row->created_at->format('Y-m-d H:i:s');;
            })
            ->addColumn('see_button', function($row){
                $btn = <<<HEREDOC
                    <button onclick="seeCoordinateOnMap($row->lat, $row->long)"><i class="fa-solid fa-eye"></i></button>
                HEREDOC;

                return $btn;
            })
            ->addColumn('lat_long', function($row){
                return $row->lat.', '.$row->long;
            })
            ->addColumn('status', function($row){
                return $row->status == 1? 'success': $row->error_message;
            })
            ->rawColumns([
                'time',
                'see_button',
                'lat_long',
                'status'
            ])
            ->make(true);
    }

    public function toggle_tracking_number(Request $request){
        $this->service->toggleTracking($request->msisdn);

        return new ApiResponse(null);
    }
}
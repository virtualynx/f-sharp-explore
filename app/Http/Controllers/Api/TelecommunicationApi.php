<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use App\Models\TrackedNumber;
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
                            'message' => $e->getMessage()
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

    public function telco_registration(Request $request)
    {
        $value = $request->value;
        $type = $request->type;
        try{
            $response = $this->service->getTelcoNumber($value, $type);
            
            return new ApiResponse($response);
        }catch(Exception $e){
            return new ApiResponse(null, $e->getCode(), $e->getMessage());
        }
    }
    
    public function get_tracked_number(string $msisdn){
        $data = $this->service->getTrackedNumber($msisdn);

        return new ApiResponse($data);
    }

    public function save_tracked_number(Request $request){
        if($request->mode == 'add'){
            $this->service->addTrackedNumber($request->all());
        }else if($request->mode == 'edit'){
            $this->service->saveTrackedNumber($request->msisdn, $request->all());
        }

        return new ApiResponse(null);
    }

    public function delete_tracked_number(Request $request){
        $data = $this->service->deleteTrackedNumber($request->msisdn);

        return new ApiResponse($data);
    }

    public function datatable_tracked_numbers(){
        $data = $this->service->getTrackedList();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btnRunning = $row->running == 1? 'stop': 'play';
                $color = $row->running == 1? 'success': 'danger';

                $actionBtn = <<<HEREDOC
                    <button onclick="deleteNumber('$row->msisdn')" class="btn btn-danger btn-square btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                    <span data-toggle="tooltip" data-placement="right" data-original-title="Edit">
                        <button onclick="editNumber('$row->msisdn')" class="btn btn-default btn-square btn-sm" role="button" data-toggle="modal" data-target="#modal_add_edit_number"><i class="fa fa-pencil"></i></button>
                    </span>
                    <span data-toggle="tooltip" data-placement="right" data-original-title="Tracking Log">
                        <button onclick="trackingLog('$row->msisdn')" class="btn btn-warning btn-square btn-sm" role="button" data-toggle="modal" data-target="#modal_tracking_log"><i class="fa fa-folder-open-o"></i></button>
                    </span>
                    <span data-toggle="tooltip" data-placement="right" data-original-title="Tracking Geofences">
                        <button onclick="loadGeofence('$row->msisdn')" class="btn btn-primary btn-square btn-sm" role="button" data-toggle="modal" data-target="#modal_set_geofence"><i class="icon-map"></i></button>
                    </span>
                    <button onclick="toggleTracking('$row->msisdn')" class="btn btn-$color btn-square btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Toggle Tracking"><i class="fa fa-$btnRunning"></i></button>
                HEREDOC;

                // <button onclick="deleteNumber('$row->msisdn')"><i class="fa-solid fa-xmark"></i></i></button>
                // <button onclick="editNumber('$row->msisdn')" data-toggle="modal" data-target="#modal_add_edit_number"><i class="fa-solid fa-pen"></i></i></button>
                // <button onclick="trackingLog('$row->msisdn')" data-toggle="modal" data-target="#modal_tracking_log"><i class="fa-solid fa-folder-open"></i></i></button>
                // <button onclick="loadGeofence('$row->msisdn')" data-toggle="modal" data-target="#modal_set_geofence"><i class="fa-solid fa-map-location-dot"></i></button>
                // <button onclick="toggleTracking('$row->msisdn')"><i class="fa-solid fa-$btnRunning"></i></button>
                // <button><i class="fa-regular fa-calendar-days"></i></button>
                
                return $actionBtn;
            })
            ->addColumn('status', function($row){
                $color = $row->running == 1? 'success': 'danger';
                $status = $row->running == 1? 'Running': 'Stopped';
                $pstatus = <<<HEREDOC
                    <span class="label label-$color">$status</span>
                HEREDOC;

                return $pstatus;
            })
            ->addColumn('success_count', function($row){
                $logs = $row->logs->toArray();
                $success = from($logs)
                    ->where(function($a){ return $a["success"] == 1; })
                    ->toArray();

                return count($success);
            })
            ->addColumn('failed_count', function($row){
                $logs = $row->logs->toArray();
                $failed = from($logs)
                    ->where(function($a){ return $a["success"] == 0; })
                    ->toArray();
                ;

                return count($failed);
            })
            ->addColumn('last_error', function($row){
                return null;
            })
            ->addColumn('last_tracked', function($row){
                return now();
            })
            ->addColumn('cron_info', function($row){
                $btn = <<<HEREDOC
                    <button onclick="deleteTracked('$row->msisdn')" class="btn btn-primary btn-square btn-sm" data-toggle="tooltip" data-placement="left" data-original-title="Cron Info"><i class="icon-eye"></i></button> 
                HEREDOC;

                return $btn;
            })
            ->rawColumns([
                'action',
                'status',
                'success_count',
                'failed_count',
                'last_error',
                'last_tracked',
                'cron_info'
            ])
            ->make(true);
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
                    <button onclick="seeCoordinateOnMap($row->lat, $row->long)" class="btn btn-primary btn-square btn-sm"><i class="icon-eye"></i></button>
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

    public function get_geofence(string $msisdn){
        $datas = $this->service->getGeofence($msisdn);
        if(count($datas) > 0){
            $points = $datas[0]->points->toArray();

            $points_arr = from($points)
                ->select(function($a){ return [$a['lat'], $a['long']]; })
                ->toArray();

            return new ApiResponse($points_arr);
        }

        return new ApiResponse([]);
    }

    public function get_geofence_v2(string $msisdn){
        $datas = $this->service->getGeofence($msisdn);
        if(count($datas) > 0){
            return new ApiResponse($datas[0]);
        }

        return new ApiResponse([]);
    }

    public function save_geofence(Request $request){
        $this->service->saveGeofence($request->msisdn, $request->action, $request->geojson);

        return new ApiResponse(null);
    }
}
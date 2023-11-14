<?php
 
namespace App\Http\Controllers;

use App\Services\TelecommunicationService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use \YaLinqo\Enumerable;

class TelecommunicationController extends _Controller
{
    private TelecommunicationService $service;

    public function __construct(TelecommunicationService $service){
        // $this->middleware('auth');
        $this->service = $service;
    }

    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function locate_number(){
    	return view('telecommunication/locate_number');
    }

    public function tracking_number(Request $request){
        if ($request->ajax()) {
            $data = $this->service->getTrackedList();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btnRunning = $row->running == 1? 'stop': 'play';

                    $actionBtn = <<<HEREDOC
                        <button onclick="deleteNumber('$row->msisdn')"><i class="fa-solid fa-xmark"></i></i></button>
                        <button onclick="editNumber('$row->msisdn')" data-toggle="modal" data-target="#modal_add_edit_number"><i class="fa-solid fa-pen"></i></i></button>
                        <button onclick="trackingLog('$row->msisdn')" data-toggle="modal" data-target="#modal_tracking_log"><i class="fa-solid fa-list"></i></i></button>
                        <button><i class="fa-solid fa-map-location-dot"></i></button>
                        <button onclick="toggleTracking('$row->msisdn')"><i class="fa-solid fa-$btnRunning"></i></button>
                    HEREDOC;

                    // <button><i class="fa-regular fa-calendar-days"></i></button>
                    
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $color = $row->running == 1? 'success': 'danger';
                    $status = $row->running == 1? 'Running': 'Stopped';
                    $pstatus = <<<HEREDOC
                        <p class="text-$color">$status</p>
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
                        <button onclick="deleteTracked('$row->msisdn')"><i class="fa-solid fa-eye"></i></button>
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

    	return view('telecommunication/tracking_number');
    }
}
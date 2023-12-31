<?php

namespace App\Services;

use App\Models\TrackedNumber;
use App\Models\TrackedNumberGeofence;
use App\Models\TrackedNumberLog;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TelecommunicationService extends _GeneralService
{
    private SearchLogService $logService;

    public function __construct(SearchLogService $logService)
    {
        parent::__construct();
        $this->logService = $logService;
    }

    public function locateMsisdn(string $msisdn)
    {
        $uri = config('api.uri.general.msisdn_track');
        $response = null;

        try{
            $response = $this->getHttpClient()->request(
                'GET', 
                $uri . '/' . $msisdn,
                [
                    'timeout' => 30, // Response timeout
                    'connect_timeout' => 30, // Connection timeout
                ]
            );
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            throw new Exception("Belum dapat menghubungi API Tracking Nomor, harap coba kembali nanti", 2);
        }catch(Exception $e){
            Log::error($e->getMessage(), $e);
        }

        if($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);
            if (isset($resp_arr['status']) && $resp_arr['status'] == 1 && $resp_arr['statusCode'] == 200) {
                $resp_respon = $resp_arr['respon'][0];
                $data = [
                    'msisdn' => $msisdn,
                    'imsi' => $resp_respon['imsi'],
                    'imei' => $resp_respon['imei'],
                    'provider' => $resp_respon['net_provider'],
                    'address' => $resp_respon['address'],
                    'phone' => $resp_respon['phone'],
                    'lat' => (float)$resp_respon['latitude'],
                    'long' => (float)$resp_respon['longitude'],
                    'province' => !empty($resp_respon['province'])? trim($resp_respon['province']): null,
                    'city' => !empty($resp_respon['city'])? trim($resp_respon['city']): null,
                    'district' => !empty($resp_respon['district'])? trim($resp_respon['district']): null,
                    'subdistrict' => !empty($resp_respon['subdistrict'])? trim($resp_respon['subdistrict']): null,
                ];

                $this->logService->locateMsisdn($data);

                return $data;
            } else if (isset($resp_arr['res'])) {
                if ($resp_arr['res'] == 'success') {
                    throw new Exception($resp_arr['msg'], 1);
                } else if ($resp_arr['res'] == 'failed') {
                    throw new Exception($resp_arr['msg'], 2);
                }
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getTrackedList()
    {
        // $result = TrackedNumber::get();
        return TrackedNumber::all();
    }

    public function getTrackedNumber(string $msisdn)
    {
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();

        return $existing;
    }

    public function addTrackedNumber(array $data)
    {
        $newdata = new TrackedNumber();
        $newdata->fill($data);

        $newdata->save();
    }

    public function saveTrackedNumber(string $msisdn, array $data): bool
    {
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();
        $existing->fill($data);

        return $existing->save();
    }

    public function deleteTrackedNumber(string $msisdn): bool
    {
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();

        return $existing->delete();
    }

    public function getTrackingLog(string $msisdn)
    {
        $datas = TrackedNumberLog::where('msisdn', $msisdn)->get();

        return $datas;
    }

    public function toggleTracking(string $msisdn)
    {
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();

        $running = $existing->running == 0 ? 1 : 0;

        $existing->running = $running;

        return $existing->save();;
    }

    public function getGeofence(string $msisdn)
    {
        $datas = TrackedNumberGeofence::where('msisdn', $msisdn)->get();

        return $datas;
    }

    public function saveGeofence(string $msisdn, string $action, string $geojson)
    {
        $datas = TrackedNumberGeofence::where('msisdn', $msisdn)->get();

        $data = null;
        if (count($datas) == 0) {
            $data = new TrackedNumberGeofence();
            $data->msisdn = $msisdn;
        } else if (count($datas) == 1) {
            $data = $datas[0];
        } else if (count($datas) > 1) {
            throw new Exception('Multiple Geofence is not supported yet');
        }

        if(!empty($geojson)){
            $data->action = $action;
            $data->geojson = $geojson;
        }else if(count($datas) == 1 && empty($geojson)){
            TrackedNumberGeofence::where('msisdn', $msisdn)->delete();
        }

        return $data->save();
    }

    public function getTelcoNumber(string $value, string $type)
    {
        $uri = config('api.uri.general.telco_registration');

        $response = $this->getHttpClient()->request('GET', $uri . '/' . $type . '/' . $value);

        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);

            if (isset($resp_arr['status'])) {
                if ($resp_arr['status'] == "data_ok") {
                    $reg_datas = $resp_arr['reg_data'];

                    $search_logs = [];
                    foreach ($reg_datas as $loop) {
                        $log = [
                            'msisdn' => $loop['NO_PESERTA'],
                            'nik' => $loop['PENCARIAN'],
                            'operator' => $loop['INSTANSI']
                        ];
                        array_push($search_logs, $log);
                    }

                    $this->logService->telcoRegistration($search_logs);

                    return $resp_arr['reg_data'];
                } else if ($resp_arr['status'] == "data_tidak_ada") {
                    return [];
                }
            } else {
                throw new Exception("Unknown Error", 99);
            }
        } else {
            throw new Exception($response->getReasonPhrase() . '(' . $response->getStatusCode() . ')', 99);
        }
    }

    public function getImsiOrImei(string $value, string $type)
    {
        $response = DB::table('search_logs_locate_msisdn')
        ->where($type, '=', $value)
        ->get();

        if ($response){
            return response()->json([
                'data' => $response
            ], 200);
        } else {
            return response()->json([
                'data' => ''
            ], 99);
        }
        }
    }


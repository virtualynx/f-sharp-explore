<?php

namespace App\Services;

use App\Models\TrackedNumber;
use App\Models\TrackedNumberGeofence;
use App\Models\TrackedNumberLog;
use Exception;

class TelecommunicationService extends _GeneralService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function locateMsisdn(string $msisdn)
    {
        $uri = config('api.uri.general.msisdn_track');

        $response = $this->getHttpClient()->request('GET', $uri . '/' . $msisdn);
        if ($response->getStatusCode() == 200) {
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
                    'long' => (float)$resp_respon['longitude']
                ];

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

    public function getTrackedList(){
        // $result = TrackedNumber::get();
        return TrackedNumber::all();
    }

    public function getTrackedNumber(string $msisdn){
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();

        return $existing;
    }

    public function addTrackedNumber(array $data){
        $newdata = new TrackedNumber();
        $newdata->fill($data);

        $newdata->save();
    }

    public function saveTrackedNumber(string $msisdn, array $data): bool{
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();
        $existing->fill($data);

        return $existing->save();
    }

    public function deleteTrackedNumber(string $msisdn): bool{
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();

        return $existing->delete();
    }

    public function getTrackingLog(string $msisdn){
        $datas = TrackedNumberLog::where('msisdn', $msisdn)->get();

        return $datas;
    }

    public function toggleTracking(string $msisdn){
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();
        
        $running = $existing->running == 0? 1: 0;

        $existing->running = $running;

        return $existing->save();;
    }

    public function getGeofence(string $msisdn){
        $datas = TrackedNumberGeofence::where('msisdn', $msisdn)->get();

        return $datas;
    }

    public function saveGeofence(string $msisdn, string $action, string $geojson){
        $datas = TrackedNumberGeofence::where('msisdn', $msisdn)->get();

        $data = null;
        if(count($datas) == 0){
            $data = new TrackedNumberGeofence();
            $data->msisdn = $msisdn;
        }else if(count($datas) == 1 && empty($geojson)){
            $data = $datas[0];
            $data->delete();
            
            return $data->save();
        }else if(count($datas) == 1){
            $data = $datas[0];
        }else if(count($datas) > 1){
            throw new Exception('Multiple Geofence is not supported yet');
        }
        $data->action = $action;
        $data->geojson = $geojson;

        return $data->save();
    }
    
    public function getTelcoNumber(string $value, string $type)
    {
        $uri = config('api.uri.general.telco_registration');

        $response = $this->getHttpClient()->request('GET', $uri . '/' . $type . '/' . $value);

        if ($response->getStatusCode() == 200) {
            $resp_arr = json_decode($response->getBody(), true);

            if (isset($resp_arr['status']) && $resp_arr['status'] == "data_ok") {
                if ($resp_arr['status'] == "data_ok") {

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
}

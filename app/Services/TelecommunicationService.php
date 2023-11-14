<?php

namespace App\Services;

use App\Models\TrackedNumber;
use App\Models\TrackedNumberLog;
use Exception;

class TelecommunicationService extends _GeneralService
{
    public function __construct(){
        parent::__construct();
    }

    public function locateMsisdn(string $msisdn){
        $uri = config('api.uri.general.msisdn_track');

        $response = $this->getHttpClient()->request('GET', $uri.'/'.$msisdn);
        if($response->getStatusCode() == 200){
            $resp_arr = json_decode($response->getBody(), true);
            if(isset($resp_arr['status']) && $resp_arr['status']==1 && $resp_arr['statusCode']==200){
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
            }else if(isset($resp_arr['res'])){
                if($resp_arr['res'] == 'success'){
                    throw new Exception($resp_arr['msg'], 1);
                }else if($resp_arr['res'] == 'failed'){
                    throw new Exception($resp_arr['msg'], 2);
                }
            }else{
                throw new Exception("Unknown Error", 99);
            }
        }else{
            throw new Exception($response->getReasonPhrase().'('.$response->getStatusCode().')', 99);
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
        // $newdata->fill([
        //     'msisdn' => $data['phone'],
        //     'name' => $data['name'],
        //     'group' => $data['group'],
        //     'cron_minute' => $data['cron_minute'],
        //     'cron_hour' => $data['cron_hour'],
        //     'cron_dayofmonth' => $data['cron_dayofmonth'],
        //     'cron_month' => $data['cron_month'],
        //     'cron_dayofweek' => $data['cron_dayofweek']
        // ]);
        $data['msisdn'] = $data['phone'];
        unset($data['phone']);
        $newdata->fill($data);

        $newdata->save();
    }

    public function saveTrackedNumber(string $msisdn, array $data): bool{
        $existing = TrackedNumber::where('msisdn', $msisdn)->first();
        unset($data['phone']);
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
}
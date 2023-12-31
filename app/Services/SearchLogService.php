<?php

namespace App\Services;

use App\Models\SearchLogDukcapil;
use App\Models\SearchLogLocateMsisdn;
use App\Models\SearchLogTelcoRegistration;
use Carbon\Carbon;

class SearchLogService
{
    public function __construct()
    {
    }

    public function locateMsisdn(array $data)
    {
        $log = new SearchLogLocateMsisdn();
        $log->msisdn = $data['msisdn'];
        $log->imei = $data['imei'];
        $log->imsi = $data['imsi'];
        $log->phone = $data['phone'];
        $log->lat = $data['lat'];
        $log->long = $data['long'];
        $log->operator = $data['provider'];
        $log->province = $data['province'];
        $log->city = $data['city'];
        $log->district = $data['district'];
        $log->subdistrict = $data['subdistrict'];

        return $log->save();
    }

    public function telcoRegistration(array $datas){
        foreach($datas as $data){
            $msisdn = $data['msisdn'];
            $nik = $data['nik'];
            $operator = $data['operator'];

            $existing = SearchLogTelcoRegistration::find([$msisdn, $nik]);
            if(empty($existing)){
                $log = new SearchLogTelcoRegistration();
                $log->msisdn = $msisdn;
                $log->nik = $nik;
                $log->operator = $operator;

                $log->save();
            }
        }
    }

    public function dukcapil(array $data){
        $nik = $data['NIK'];

        $existing = SearchLogDukcapil::find($nik);
        if(!empty($existing) && empty($existing->photo_path) && !empty($data['FOTO'])){
            // $existing->photo_path = $data['FOTO'];
            // $existing->save();
        }else if(empty($existing)){
            $log = new SearchLogDukcapil();
            $log->nik = $nik;
            $log->nkk = $data['NKK'];
            $log->religion = $data['AGAMA'];
            $log->address = $data['ALAMAT'];
            $blood_type = $data['GOL_DARAH'];
            $blood_type = !empty($blood_type) && (strlen($blood_type)<=5)? strtoupper($blood_type): null;
            $log->blood_type = $blood_type;
            $log->gender = $data['JENIS_KLMIN'];
            $log->occupation = $data['JENIS_PKRJN'];
            $log->name = $data['NAMA_LGKP'];
            $log->father = $data['NAMA_LGKP_AYAH'];
            $log->mother = $data['NAMA_LGKP_IBU'];
            $log->education = $data['PDDK_AKH'];
            $log->marital = $data['STAT_KWN'];

            $dob = Carbon::parse($data['TGL_LHR'])->format('Y-m-d'); 
            $log->dob = $dob;

            // if(!empty($data['FOTO'])){
            //     $existing->photo_path = $data['FOTO'];
            // }

            $log->created_at = Carbon::now();
            $log->save();
        }
    }
}

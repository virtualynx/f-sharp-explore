<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\_Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResponse;
use App\Services\ReportingService;
use Exception;

class ReportingApi extends _Controller{
    private ReportingService $service;

    public function __construct(ReportingService $service){
        $this->service = $service;
    }

    public function search_statistic_by(Request $request, string $by){
        $params = $request->all();
        $province_id = empty($params['province_id'])? '': $params['province_id'];
        $city_id = empty($params['city_id'])? '': $params['city_id'];
        $datas = $this->service->getSearchStatisticBy($by, $province_id, $city_id);

        return new ApiResponse($datas);
    }

    public function most_located_msisdn_by($by){
        $datas = $this->service->getMostLocateMsisdnCities($by);

        $datas = from($datas)
            ->orderByDescending(function($a) { return $a->count; })
            ->toArray();

        return new ApiResponse($datas);
    }

    public function map_visualization(Request $request){
        $province = $request->province;

        $datas = $this->service->getMapVisualization();
        

        return new ApiResponse($datas);
    }
}
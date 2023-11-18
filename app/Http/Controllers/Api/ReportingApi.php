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

    public function search_statistic_by($by){
        $datas = $this->service->getSearchStatisticBy($by);

        return new ApiResponse($datas);
    }
}
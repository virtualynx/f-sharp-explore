<?php

namespace App\Services;

use App\Enum\StatisticByEnum;
use App\Models\GenerationMap;
use App\Models\SearchLogDukcapil;
use App\Models\SearchLogLocateMsisdn;
use Exception;
use Illuminate\Support\Facades\DB;

class ReportingService
{
    public function __construct(){
    }

    public function getSearchStatisticBy(string $by){
        if($by == StatisticByEnum::OPERATOR->value){
            $datas = SearchLogLocateMsisdn::select("operator", DB::raw("count(1) as count"))
                ->groupBy('operator')
                ->get()
                ->toArray();
            // $datas = DB::select('
            //         select operator, count(1) as count 
            //         from search_logs_locate_msisdn 
            //         group by operator
            //     ');
            
            return $datas;
        }else if(
            $by == StatisticByEnum::GENERATION->value
            || $by == StatisticByEnum::OCCUPATION->value
            || $by == StatisticByEnum::EDUCATION->value
            || $by == StatisticByEnum::RELIGION->value
            || $by == StatisticByEnum::GENDER->value
        ){
            $datas = [];
            if($by == StatisticByEnum::GENERATION->value){
                // $raws = DB::select('
                //     select dob, count(1) as count 
                //     from search_logs_dukcapil 
                //     group by dob
                // ');
                $raws = SearchLogDukcapil::select(
                        "dob", 
                        DB::raw("count(1) as count")
                    )
                    ->groupBy('dob')
                    ->get();
                
                $generationMapsRaw = GenerationMap::get();
                $generationMaps = [];
                foreach($generationMapsRaw as $loop){
                    $generationMaps[] = [
                        'lowerbound' => date('Y-m-d', strtotime("01/01/".$loop->lowerbound)),
                        'upperbound' => date('Y-m-d', strtotime("31/12/".$loop->upperbound)),
                        'name' => $loop->name
                    ];
                }
                
                foreach($raws as $capilData){
                    $generation = '';
                    foreach($generationMaps as $genMap){
                        if($genMap['lowerbound'] <= $capilData->dob && $capilData->dob <= $genMap['upperbound']){
                            $generation = $genMap['name'];
                            break;
                        }
                    }

                    if(!isset($datas[$generation])){
                        $datas[$generation] = 0;
                    }

                    $datas[$generation] += $capilData->count;
                }
            }else{
                $column = 'unknown';
                if($by == StatisticByEnum::OCCUPATION->value){
                    $column = 'occupation';
                }else if($by == StatisticByEnum::EDUCATION->value){
                    $column = 'education';
                }else if($by == StatisticByEnum::RELIGION->value){
                    $column = 'religion';
                }else if($by == StatisticByEnum::GENDER->value){
                    $column = 'gender';
                }

                $raws = SearchLogDukcapil::select(
                        $column, 
                        DB::raw("count(1) as count")
                    )
                    ->groupBy($column)
                    ->get();

                $datas = $raws->toArray();
            }
            
            return $datas;
        }

        throw new Exception('Invalid argument "by", '. $by, 2);
    }
}
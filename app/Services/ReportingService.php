<?php

namespace App\Services;

use App\Enums\StatisticByEnum;
use App\Models\GenerationMap;
use App\Models\SearchLogDukcapil;
use App\Models\SearchLogLocateMsisdn;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ReportingService
{
    public function __construct(){
    }

    public function getSearchStatisticBy(string $by){
        if(
            $by == StatisticByEnum::OPERATOR->value
            || $by == StatisticByEnum::HANDSET->value
        ){
            $column = 'unknown';
            if($by == StatisticByEnum::OPERATOR->value){
                $column = 'operator';
            }else if($by == StatisticByEnum::HANDSET->value){
                $column = 'phone';
            }

            $datas = SearchLogLocateMsisdn::select(
                    $column, 
                    DB::raw("count(1) as count")
                )
                ->groupBy($column)
                ->get()
                ->toArray();
            
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
                        // 'lowerbound' => date('Y-m-d', strtotime("01/01/".$loop->lowerbound)),
                        'lowerbound' => Carbon::createFromFormat('Y-m-d H:i:s', $loop->lowerbound.'-01-01 00:00:00'),
                        // 'upperbound' => date('Y-m-d', strtotime("31/12/".$loop->upperbound)),
                        'upperbound' => Carbon::createFromFormat('Y-m-d H:i:s', $loop->upperbound.'-12-31 23:59:59'),
                        'name' => $loop->name
                    ];
                }
                
                $preResult = [];
                foreach($raws as $capilData){
                    $dob = Carbon::createFromFormat('Y-m-d H:i:s', $capilData->dob.'00:00:00');
                    $generation = '';
                    foreach($generationMaps as $genMap){
                        if($genMap['lowerbound'] <= $dob && $dob <= $genMap['upperbound']){
                            $generation = $genMap['name'];
                            break;
                        }
                    }

                    if(!isset($preResult[$generation])){
                        $preResult[$generation] = 0;
                    }

                    $preResult[$generation] += $capilData->count;
                }

                foreach($preResult as $gen => $count){
                    $datas[] = [
                        'generation' => $gen,
                        'count' => $count
                    ];
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

    public function getMostLocateMsisdnCities(string $by, int $limit = 10){
        $raw = SearchLogLocateMsisdn::select(
                $by, 
                DB::raw("count(1) as count")
            )
            ->groupBy($by)
            // ->orderBy(DB::raw('count(1)', 'DESC'))
            ->orderBy(DB::raw('count', 'DESC'))
            ->limit($limit)
            ->get();

        return $raw;
    }

    public function getMapVisualization(string $province = null){
        $raw = SearchLogLocateMsisdn::select(
                'province', 
                DB::raw("count(1) as count")
            )
            ->groupBy('province')
            ->get();

        return $raw;
    }
}
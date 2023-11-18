<?php

namespace Database\Seeders;

use App\Models\GenerationMap;
use App\Models\SearchLogLocateMsisdn;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SearchLogLocateMsisdnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('search_logs_locate_msisdn')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'msisdn' => '6282285391626',
            'imei' => '969792758985619',
            'imsi' => '510108572391626',
            'phone' => 'Merek Hape',
            'lat' => -6.549493,
            'long' => 106.787834,
            'operator' => 'Indoperator',
            'created_at' => Carbon::now()
        ]);
        
        // SearchLogLocateMsisdn::factory()->create([
        //     'msisdn' => '6282285391626',
        //     'imei' => '969792758985619',
        //     'imsi' => '510108572391626',
        //     'phone' => 'Merek Hape',
        //     'lat' => -6.549493,
        //     'long' => 106.787834,
        //     'operator' => 'Indoperator'
        // ]);
    }
}

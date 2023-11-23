<?php

namespace Database\Seeders;

use App\Models\GenerationMap;
use App\Models\SearchLogDukcapil;
use App\Models\SearchLogLocateMsisdn;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class SearchLogDukcapilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('search_logs_locate_msisdn')->insert([
        //     'uuid' => Uuid::uuid4()->toString(),
        //     'msisdn' => '6282285391626',
        //     'imei' => '969792758985619',
        //     'imsi' => '510108572391626',
        //     'phone' => 'Merek Hape',
        //     'lat' => -6.549493,
        //     'long' => 106.787834,
        //     'operator' => 'Indoperator',
        //     'created_at' => Carbon::now()
        // ]);

        $religion_arr = [
            'ISLAM',
            'KRISTEN',
            'BUDHA',
            'HINDU'
        ];

        $occupation_arr = [
            'PNS',
            'KARYAWAN SWASTA',
            'WIRASWASTA',
            'IBU RUMAH TANGGA',
            'MENGANGGUR'
        ];

        $education_arr = [
            'SD',
            'SMP',
            'SMA',
            'D3',
            'S1',
            'S2',
            'S3'
        ];

        $faker = \Faker\Factory::create();

        for($a = 0; $a < 50; $a++){
            $rand_date = $faker->dateTimeBetween('1960-01-01 00:00:00', '2000-12-31 23:59:59');
            $rand_number = random_int(0, 999999);
        
            DB::table('search_logs_dukcapil')->insert([
            // SearchLogDukcapil::factory()->create([
                'nik' => Str::random(16),
                'nkk' => Str::random(16),
                'religion' => $religion_arr[random_int(0, count($religion_arr)-1)],
                'address' => 'Dummy address',
                'blood_type' => 'A',
                'gender' => random_int(0, 1)==0? 'Laki-Laki': 'Perempuan',
                'occupation' => $occupation_arr[random_int(0, count($occupation_arr)-1)],
                'name' => 'Name '.$rand_number,
                'father' => 'Father name '.$rand_number,
                'mother' => 'Mother name '.$rand_number,
                'education' => $education_arr[random_int(0, count($education_arr)-1)],
                'marital' => random_int(0, 1)==0? 'Kawin': 'Belum Kawin',
                // 'dob' => 'Indoperator' date("Y-m-d H:i:s", $rand_date)
                'dob' =>  $rand_date
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\GenerationMap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerationMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // GenerationMap::factory()->create([
        //     'gen_id' => 'baby_boomer',
        //     'name' => 'Baby Boomer',
        //     // 'lowerbound' => 1946,
        //     'lowerbound' => 0,
        //     'upperbound' => 1964
        // ]);
        DB::table('generation_map')->insert([
            'gen_id' => 'baby_boomer',
            'name' => 'Baby Boomer',
            // 'lowerbound' => 1946,
            'lowerbound' => 1900,
            'upperbound' => 1964
        ]);
        DB::table('generation_map')->insert([
            'gen_id' => 'gen_x',
            'name' => 'Generation X',
            'lowerbound' => 1965,
            'upperbound' => 1980
        ]);
        DB::table('generation_map')->insert([
            'gen_id' => 'gen_y',
            'name' => 'Generation Y',
            'lowerbound' => 1981,
            'upperbound' => 1996
        ]);
        DB::table('generation_map')->insert([
            'gen_id' => 'gen_z',
            'name' => 'Generation Z',
            'lowerbound' => 1997,
            // 'upperbound' => 2012
            'upperbound' => 2100
        ]);
    }
}

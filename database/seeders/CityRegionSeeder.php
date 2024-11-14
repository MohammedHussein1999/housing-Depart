<?php

namespace Database\Seeders;

use App\Models\CityRegion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CityRegion::truncate();
        CityRegion::firstOrCreate([
            "region_id"=> 1 ,
            "city_id"=>3,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}

<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();

        $jsonPath = storage_path('app/json/city.json');
        $jsonData = file_get_contents($jsonPath);
        $data = json_decode($jsonData, true);
        // dd($data);
        $count = 1;
        foreach ($data['cities'] as $city) {


            City::firstOrCreate([

                "city_ar" => $city["name_ar"] ?? null,
                'region_id' => $city["region_id"] ?? null,
                "city_en" => $city["name_en"] ,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

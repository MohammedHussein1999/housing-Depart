<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Region::truncate();

        $jsonPath = storage_path('app/json/city.json');
        $jsonData = file_get_contents($jsonPath);
        $data = json_decode($jsonData, true);
        foreach ($data['regions'] as $region) {
            $exists = Region::where('region_ar', $region["name_ar"])->where('region_en', $region["name_en"])->exists();
            if (!$exists) {
                Region::create([
                    "region_ar" => $region["name_ar"],
                    "region_en" => $region["name_en"],
                ]);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

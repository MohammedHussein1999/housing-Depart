<?php

namespace App\Http\Controllers;

// use App\Models\City;

use App\Models\City;
use App\Models\Compon;
use App\Models\Region;
use App\Models\Room;

// use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('cities.coms.units.rooms')->get();
        $rr = City::with('coms.units.rooms')->get();
        $com = Compon::with('units.rooms')->get();

        $room = Room::sum('numberPeople');
        // $regions->;

        return view("collections.collections", compact(["regions", "room", 'rr', 'com']));
        // return response($rr);
    }
    public function show($id)
    {
        $region = Region::with("cities")->find($id);
        if ($id === 0) {

            $region = Region::get();
            return
                response($region);
        }

        return response($region);
    }
}

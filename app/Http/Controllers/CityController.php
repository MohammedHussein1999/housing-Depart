<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Compon;
use App\Models\Region;
use App\Models\Rooms;
use App\Models\Unit;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        // $cittes = City::with('regions')->get();
        $region = Region::with('cities.coms.units.rooms')->get();
        $cittes = City::get();

   /*      $units = Unit::get();
        $rooms = Rooms::get(); */
        return view('housing.index', compact(['region', 'cittes',"rooms",'units']));

    }

    public function stor(Request $request)
    {
        City::create($request->all());
    }
}

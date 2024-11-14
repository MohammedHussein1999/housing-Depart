<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponRequest;
use App\Models\City;
use App\Models\Compon;
use App\Models\Employees;
use App\Models\Region;
use App\Models\Unit;
use App\Models\Room;
use App\Models\Rooms;


class ComponController extends Controller
{
    public function index($id)
    {
        $City = City::with(['coms.units.rooms'])->find($id);
        $cmd = Compon::with('units')->get();

        return view('collections.cities', compact(["City", 'id', 'cmd']));
    }


    public function create(ComponRequest $request)
    {
        Compon::create($request->all());
        return redirect()->back();
    }

    public function show($id)
    {
        $data =  Employees::find($id);
        $region = Region::with(['cities.coms.units.rooms'])->get();

        // $data->unit->compon->city->regions;
        // return response($data);
        return view('notifications.test', compact(['data', 'region', 'id']));
    }




    // حذف المجمع
    public function deleteShow($id)
    {
        $show = Compon::findOrFail($id);
        $show->delete();
        return redirect()->back()->with('success', 'تم حذف المجمع بنجاح');
    }

    // حذف الوحدة السكنية
    public function deleteUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->back()->with('success', 'تم حذف الوحدة السكنية بنجاح');
    }

    // حذف الغرفة
    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->back()->with('success', 'تم حذف الغرفة بنجاح');
    }
}

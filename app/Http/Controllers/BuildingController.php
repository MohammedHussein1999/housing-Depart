<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = DB::table('building_types')->get();
        $buildingType = DB::table('building_types')->get();
        $collection = DB::table('collections')->where('approve', 2)->get();
        return view('collections.buildingCreate')->with('collection', $collection)
            ->with('buildingType', $buildingType)->with('region', $region);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'region' => 'required|string',
            'collectionId' => 'required|string',
            'name' => 'required|string',
            'buildingType' => 'required|string',
        ]);
        $building = new Building();
        $building->city = $request->city;
        $building->region = $request->region;
        $building->collectionId = $request->collectionId;
        $building->name = $request->name;
        $building->buildingType = $request->buildingType;
        $building->location = $request->location;
        $building->value = $request->value;
        $building->count = $request->count;
        if ($request->file("file") != null) {
            $building_data = $request->file("file");
            $building_name = \time() . $building_data->getClientOriginalName();
            $location =  \public_path('./PDF folder/');
            $building_data->move($location, $building_name);
            $building->file = $building_name;
        }
        if ($request->active == 1) {
            $building->active = $request->active;
        } else {
            $building->active = 0;
        }
        $building->attach = $request->attach;
        if (auth()->user()->type == 2) {
            $building->approve = 2;
        } elseif (auth()->user()->type == 1) {
            $building->approve = 3;
        }
        $building->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $building = Building::find($id);
        $coll = DB::table('collections')->get();
        $type = DB::table('building_types')->get();
        return view('collections.editBuilding')->with('building', $building)
            ->with('coll', $coll)->with('type', $type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $building = Building::find($id);
        if ($request->city != null) {
            $building->city = $request->city;
        }
        if ($request->region != null) {
            $building->region = $request->region;
        }
        if ($request->collectionId != null) {
            $building->collectionId = $request->collectionId;
        }
        $building->name = $request->name;
        $building->buildingType = $request->buildingType;
        $building->location = $request->location;
        $building->value = $request->value;
        $building->count = $request->count;
        if ($request->file("file") != null) {
            if ($building->file != null) {
                $path = \public_path() . "/PDF folder/" . $building->file;
                \unlink($path);
                $building_data = $request->file("file");
                $building_name = \time() . $building_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $building_data->move($location, $building_name);
                $building->file = $building_name;
            } else {
                $building_data = $request->file("file");
                $building_name = \time() . $building_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $building_data->move($location, $building_name);
                $building->file = $building_name;
            }
        }
        if ($request->active == 1) {
            $building->active = $request->active;
        } else {
            $building->active = 0;
        }
        $building->attach = $request->attach;
        $building->save();
        return \redirect()->route('collection.index')->with('done', 'done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $building = Building::find($id);
        $apartment = DB::table('apartments')->where('buildingId', '=', $building->id)->first();
        if ($apartment != null) {
            return \redirect()->back()->with('remove', 'remove');
        }
        if ($building->file != null) {
            $path = \public_path() . "/PDF folder/" . $building->file;
            \unlink($path);
            $building->file = null;
        }
        $building->delete();
        return redirect()->back()->with('done', 'done');
    }

    public function active($id)
    {
        $building = Building::find($id);
        if ($building->active == 1) {
            $building->active = 2;
            $building->save();
        } else {
            $building->active = 1;
            $building->save();
        }
        return redirect()->back()->with('done', 'done');
    }

    public function download($id)
    {
        $drive = Building::find($id);
        $drive_name = $drive->file;
        $path = \public_path() . "/PDF folder/" . $drive_name;
        return \response()->download($path);
    }

    public function approve($id)
    {
        $building = Building::find($id);
        $building->approve += 1;
        $building->save();
        return redirect()->back()->with('done', 'done');
    }

    public function notApprove($id)
    {
        $building = Building::find($id);
        $building->approve = 0;
        $building->save();
        return redirect()->back()->with('done', 'done');
    }

    public function again($id)
    {
        $building = Building::find($id);
        $building->approve = 1;
        $building->save();
        return redirect()->back()->with('done', 'done');
    }
}

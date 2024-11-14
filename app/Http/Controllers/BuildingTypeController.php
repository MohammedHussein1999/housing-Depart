<?php

namespace App\Http\Controllers;

use App\Models\BuildingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingTypeController extends Controller
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
        $buildingType = DB::table('building_types')->get();
        return view('setting.type')->with('buildingType', $buildingType);
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
            'name' => 'required|string',
        ]);
        $type = new BuildingType();
        $type->name = $request->name;
        $type->status = 1;
        $type->active = 1;
        $type->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingType $buildingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingType $buildingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingType $buildingType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = BuildingType::find($id);
        $type->delete();
        return redirect()->back()->with('done', 'done');
    }
    public function active($id)
    {
        $type = BuildingType::find($id);
        if ($type->active == 1) {
            $type->active = 2;
            $type->save();
        } else {
            $type->active = 1;
            $type->save();
        }
        return redirect()->back()->with('done', 'done');
    }
    public function status($id)
    {
        $type = BuildingType::find($id);
        if ($type->status == 1) {
            $type->status = 2;
            $type->save();
        } else {
            $type->status = 1;
            $type->save();
        }
        return redirect()->back()->with('done', 'done');
    }
}

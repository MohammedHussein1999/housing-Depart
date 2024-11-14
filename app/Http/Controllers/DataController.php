<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DataImport;
use App\Models\Building;
use App\Models\Collection;
use App\Models\Housing;
use App\Models\Out;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            "file" => "required|file|mimes:xlsx|max:3072",
        ]);
        DB::delete("delete from data");
        Excel::import(new DataImport, $request->file);
        return \redirect()->back()->with("done", "donee");
    }


    public function index()
    {
        $coll = Collection::all();
        $building = Building::all();
        $data = Data::all();
        if (auth()->user()->type == 1) {
            $housing = DB::table('housings')->where('approve', 3)->get();
            $out = Out::where('approve',3)->get();
        } else if (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            $out = [];
            foreach ($phpArray as $item) {
                $outs = DB::table('outs')->where('approve',3)->where('region', $item)->get();
                foreach ($outs as $item) {
                    $object2 = array(
                        'id' => $item->id,
                        'empId' => $item->empId,
                        'empName' => $item->empName,
                        'empNumId' => $item->empNumId,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collection' => $item->collection,
                        'building' => $item->building,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'status' => $item->status,
                        'housingDate' => $item->housingDate,
                        'reason' => $item->reason,
                        'outDate' => $item->outDate,
                    );
                    $out[] = $object2;
                }
            }
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('approve', 3)->where('region', $item)->get();
                foreach ($housings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empId' => $item->empId,
                        'empName' => $item->empName,
                        'empNumId' => $item->empNumId,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collectionId' => $item->collectionId,
                        'buildingId' => $item->buildingId,
                        'apartmentId' => $item->apartmentId,
                        'roomId' => $item->roomId,
                        'status' => $item->status,
                        'date' => $item->date,
                        'type' => $item->type,
                    );
                    $housing[] = $object;
                }
            }
        } else if (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            $out = [];
            foreach ($phpArray as $item) {
                $outs = DB::table('outs')->where('approve',3)->where('collection', $item)->get();
                foreach ($outs as $item) {
                    $object2 = array(
                        'id' => $item->id,
                        'empId' => $item->empId,
                        'empName' => $item->empName,
                        'empNumId' => $item->empNumId,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collection' => $item->collection,
                        'building' => $item->building,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'status' => $item->status,
                        'housingDate' => $item->housingDate,
                        'reason' => $item->reason,
                        'outDate' => $item->outDate,
                    );
                    $out[] = $object2;
                }
            }
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('approve', 3)->where('collectionId', $item)->get();
                foreach ($housings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empId' => $item->empId,
                        'empName' => $item->empName,
                        'empNumId' => $item->empNumId,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collectionId' => $item->collectionId,
                        'buildingId' => $item->buildingId,
                        'apartmentId' => $item->apartmentId,
                        'roomId' => $item->roomId,
                        'status' => $item->status,
                        'date' => $item->date,
                        'type' => $item->type,
                    );
                    $housing[] = $object;
                }
            }
        }
        return view('data.index')->with('out', $out)
            ->with('housing', $housing)->with('data', $data)
            ->with('coll', $coll)->with('building', $building);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Data $data)
    {
        //
    }
}

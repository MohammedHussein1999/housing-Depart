<?php

namespace App\Http\Controllers;

use App\Models\Housing;
use App\Models\Out;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutController extends Controller
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
        $coll = DB::table('collections')->where('approve',2)->get();
        $building = DB::table('buildings')->where('approve',3)->get();
        $apartment = DB::table('apartments')->get();
        $room = DB::table('rooms')->get();
        if(auth()->user()->type == 1){
            $housing = DB::table('housings')->where('approve', 3)->get();
        }else if (auth()->user()->type == 2){
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('approve', 3)->where('region',$item)->get();
                foreach($housings as $item){
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
        }else if (auth()->user()->type == 3){
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('approve', 3)->where('collectionId',$item)->get();
                foreach($housings as $item){
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
        return view('out.create')->with('housing', $housing)
            ->with('coll', $coll)->with('building', $building)
            ->with('apartment', $apartment)->with('room', $room);
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
            'empId' => 'required|string',
            'empName' => 'required|string',
            'empNumId' => 'required|string',
            'region' => 'required|string',
            'city' => 'required|string',
            'coll' => 'required|string',
            'building' => 'required|string',
            'apartment' => 'required|string',
            'room' => 'required|string',
            'status' => 'required|string',
            'housingDate' => 'required|string',
            'outDate' => 'required|string',
            'reason' => 'required|string',
        ]);
        $housing2 = DB::table('housings')->where('approve', 3)->where('empId',$request->empId)->first();
        $housing = Housing::find($housing2->id);
        $housing->delete();
        $out = new Out();
        $out->empId = $request->empId;
        $out->empName = $request->empName;
        $out->empNumId = $request->empNumId;
        $out->region = $request->region;
        $out->city = $request->city;
        $out->collection = $request->coll;
        $out->building = $request->building;
        $out->apartmentNum = $request->apartment;
        $out->roomNum = $request->room;
        $out->status = $request->status;
        $out->housingDate = $request->housingDate;
        $out->outDate = $request->outDate;
        $out->reason = $request->reason;
        if (auth()->user()->type == 2) {
            $out->approve = 2;
        } elseif (auth()->user()->type == 1) {
            $out->approve = 3;
        }
        $out->save();
        return back()->with('done','done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function show(Out $out)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function edit(Out $out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Out $out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $out = Out::find($id);
        $out->delete();
        return back()->with('remove','remove');
    }

    public function approve($id)
    {
        $out = Out::find($id);
        $out->approve += 1;
        $out->save();
        return redirect()->back()->with('done', 'done');
    }

    public function notApprove($id)
    {
        $out = Out::find($id);
        $out->approve = 0;
        $out->save();
        return redirect()->back()->with('done', 'done');
    }

    public function again($id)
    {
        $out = Out::find($id);
        $out->approve = 1;
        $out->save();
        return redirect()->back()->with('done', 'done');
    }
}

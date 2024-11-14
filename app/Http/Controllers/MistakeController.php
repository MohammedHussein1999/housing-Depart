<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Mistake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MistakeController extends Controller
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
        if (auth()->user()->type == 1) {
            $housing = DB::table('housings')->where('approve', 3)->get();
            $mistakes = DB::table('mistakes')->get();
        } else if (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            $mistakes = [];
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
                    $mistakess = DB::table('mistakes')->where('empId',$item->empId)->get();
                    foreach($mistakess as $item){
                        $object2 = array(
                            'id' => $item->id,
                            'empId' => $item->empId,
                            'empName' => $item->empName,
                            'empNumId' => $item->empNumId,
                            'mistakeDescription' => $item->mistakeDescription,
                            'date' => $item->date,
                            'status' => $item->status,
                            'description' => $item->description,
                            'file' => $item->file,
                        );
                        $mistakes[] = $object2;
                    }
                }
            }
        } else if (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $housing = [];
            $mistakes = [];
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
                    $mistakess = DB::table('mistakes')->where('empId',$item->empId)->get();
                    foreach($mistakess as $item){
                        $object2 = array(
                            'id' => $item->id,
                            'empId' => $item->empId,
                            'empName' => $item->empName,
                            'empNumId' => $item->empNumId,
                            'mistakeDescription' => $item->mistakeDescription,
                            'date' => $item->date,
                            'status' => $item->status,
                            'description' => $item->description,
                            'file' => $item->file,
                        );
                        $mistakes[] = $object2;
                    }
                }
            }
        }
        $mistake = DB::table('mistake_types')->get();
        $coll = DB::table('collections')->where('approve',2)->get();
        $building = DB::table('buildings')->where('approve',3)->get();
        $apartment = DB::table('apartments')->get();
        $room = DB::table('rooms')->get();
        return view('mistake.create')->with('housing', $housing)
            ->with('coll', $coll)->with('building', $building)
            ->with('apartment', $apartment)->with('room', $room)
            ->with('mistake', $mistake)->with('mistakes', $mistakes);
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
            'mistakeDescription' => 'required|string',
            'date' => 'required|string',
            'status' => 'required|string',
        ]);
        $mistake = new Mistake();
        $mistake->empId = $request->empId;
        $mistake->empName = $request->empName;
        $mistake->empNumId = $request->empNumId;
        $mistake->mistakeDescription = $request->mistakeDescription;
        $mistake->date = $request->date;
        $mistake->status = $request->status;
        $mistake->description = $request->description;
        if ($request->file("file") != null) {
            $mistake_data = $request->file("file");
            $mistake_name = \time() . $mistake_data->getClientOriginalName();
            $location =  \public_path('./PDF folder/');
            $mistake_data->move($location, $mistake_name);
            $mistake->file = $mistake_name;
        }
        $mistake->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function show(Mistake $mistake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function edit(Mistake $mistake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mistake $mistake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mistake  $mistake
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mistake = Mistake::find($id);
        if ($mistake->file != null) {
            $path = \public_path() . "/PDF folder/" . $mistake->file;
            \unlink($path);
            $mistake->file = null;
        }
        $mistake->delete();
        return redirect()->back()->with('done', 'done');
    }

    public function download($id)
    {
        $drive = Mistake::find($id);
        $drive_name = $drive->file;
        $path = \public_path() . "/PDF folder/" . $drive_name;
        return \response()->download($path);
    }
}

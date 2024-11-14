<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Collection;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
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
        $region = DB::table('apartments')->get();
        $apartment = DB::table('apartments')->get();
        $building = DB::table('buildings')->where('approve',3)->get();
        $buildingType = DB::table('building_types')->get();
        $collection = DB::table('collections')->where('approve',2)->get();
        return view('collections.roomCreate')->with('collection', $collection)
            ->with('buildingType', $buildingType)->with('building', $building)
            ->with('apartment', $apartment)->with('region',$region);
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
            'collectionId' => 'required|string',
            'buildingId' => 'required|string',
            'apartmentNum' => 'required|string',
            'roomNum' => 'required|string',
            'floorNum' => 'required|string',
            'count' => 'required|string',
        ]);
        $room = new Room();
        $room->collectionId = $request->collectionId;
        $room->buildingId = $request->buildingId;
        $room->apartmentNum = $request->apartmentNum;
        $room->roomNum = $request->roomNum;
        $room->floorNum = $request->floorNum;
        $room->count = $request->count;
        if ($request->file("file") != null) {
            $room_data = $request->file("file");
            $room_name = \time() . $room_data->getClientOriginalName();
            $location =  \public_path('./PDF folder/');
            $room_data->move($location, $room_name);
            $room->file = $room_name;
        }
        if ($request->active == 1) {
            $room->active = $request->active;
        } else {
            $room->active = 0;
        }
        $room->attach = $request->attach;
        $room->other = $request->other;
        $room->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coll = Collection::all();
        $building = Building::all();
        $room = Room::find($id);
        $building_type = Building::where('id',$room->buildingId)->first()->buildingType;
        $apartment = Apartment::all();
        return view('collections.editRoom')->with('room', $room)
            ->with('building', $building)->with('coll', $coll)
            ->with('apartment', $apartment)
            ->with('building_type', $building_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'roomNum' => 'required|string',
            'floorNum' => 'required|string',
            'count' => 'required|string',
        ]);
        $room = Room::find($id);
        if ($request->collectionId != null) {
            $room->collectionId = $request->collectionId;
        }
        if ($request->buildingId != null) {
            $room->buildingId = $request->buildingId;
        }
        if ($request->apartmentNum != null) {
            $room->apartmentNum = $request->apartmentNum;
        }
        $room->roomNum = $request->roomNum;
        $room->floorNum = $request->floorNum;
        $room->count = $request->count;
        if ($request->file("file") != null) {
            if ($room->file != null) {
                $path = \public_path() . "/PDF folder/" . $room->file;
                \unlink($path);
                $room_data = $request->file("file");
                $room_name = \time() . $room_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $room_data->move($location, $room_name);
                $room->file = $room_name;
            } else {
                $room_data = $request->file("file");
                $room_name = \time() . $room_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $room_data->move($location, $room_name);
                $room->file = $room_name;
            }
        }
        $room->active = $room->active;
        $room->attach = $request->attach;
        $room->other = $request->other;
        $room->save();
        return \redirect()->route('collection.index')->with('done', 'done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $housing = DB::table('housings')->where('approve', 3)->where('roomId', $id)->first();
        if ($housing != null) {
            return back()->with('remove', 'remove');
        } else {
            $room = Room::find($id);
            if ($room->file != null) {
                $path = \public_path() . "/PDF folder/" . $room->file;
                \unlink($path);
                $room->file = null;
            }
            $room->delete();
            return redirect()->back()->with('done', 'done');
        }
    }

    public function active($id)
    {
        $room = Room::find($id);
        if ($room->active == 1) {
            $room->active = 2;
            $room->save();
        } else {
            $room->active = 1;
            $room->save();
        }
        return redirect()->back()->with('done', 'done');
    }

    public function download($id)
    {
        $drive = Room::find($id);
        $drive_name = $drive->file;
        $path = \public_path() . "/PDF folder/" . $drive_name;
        return \response()->download($path);
    }
}

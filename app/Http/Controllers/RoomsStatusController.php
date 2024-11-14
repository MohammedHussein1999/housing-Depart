<?php

namespace App\Http\Controllers;

use App\Models\RoomsStatus;
use Illuminate\Http\Request;

class RoomsStatusController extends Controller
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
        //
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
        $room = new RoomsStatus();
        $room->name = $request->name;
        $room->status = 1;
        $room->active = 1;
        $room->save();
        return \redirect()->back()->with('done','done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomsStatus  $roomsStatus
     * @return \Illuminate\Http\Response
     */
    public function show(RoomsStatus $roomsStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomsStatus  $roomsStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomsStatus $roomsStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomsStatus  $roomsStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomsStatus $roomsStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomsStatus  $roomsStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = RoomsStatus::find($id);
        $room->delete();
        return redirect()->back()->with('done','done');
    }
    public function active($id)
    {
        $room = RoomsStatus::find($id);
        if($room->active == 1){
            $room->active = 2;
            $room->save();
        }else{
            $room->active = 1;
            $room->save();
        }
        return redirect()->back()->with('done','done');
    }
    public function status($id)
    {
        $room = RoomsStatus::find($id);
        if($room->status == 1){
            $room->status = 2;
            $room->save();
        }else{
            $room->status = 1;
            $room->save();
        }
        return redirect()->back()->with('done','done');
    }
}

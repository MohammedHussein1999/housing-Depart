<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Collection;
use App\Models\Data;
use App\Models\Housing;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HousingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coll = [];
        if (auth()->user()->type == 1) {
            $collection = DB::table('collections')->where('approve', 2)->get();
            foreach ($collection as $item) {
                $object = array(
                    'id' => $item->id,
                    'region_id' => $item->region,
                    'name' => $item->name
                );
                $coll[] = $object;
            }
        } else if (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $collection = [];
            foreach ($phpArray as $item) {
                $collections = DB::table('collections')->where('approve', 2)->where('region', $item)->get();
                foreach ($collections as $item) {
                    $object4 = array(
                        'id' => $item->id,
                        'region' => $item->region,
                        'name' => $item->name
                    );
                    $collection[] = $object4;
                }
            }
            foreach ($collection as $item) {
                $object = array(
                    'id' => $item['id'],
                    'region_id' => $item['region'],
                    'name' => $item['name']
                );
                $coll[] = $object;
            }
        } else if (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            foreach ($phpArray as $item) {
                $collections = DB::table('collections')->where('approve', 2)->where('id', $item)->get();
                foreach ($collections as $item) {
                    $object5 = array(
                        'id' => $item->id,
                        'region' => $item->region,
                        'name' => $item->name
                    );
                    $collection[] = $object5;
                }
            }
            foreach ($collection as $item) {
                $object = array(
                    'id' => $item['id'],
                    'region_id' => $item['region'],
                    'name' => $item['name']
                );
                $coll[] = $object;
            }
        }
        $buildings = DB::table('buildings')->where('approve', 3)->get();
        $building = [];
        foreach ($buildings as $item) {
            $object2 = array(
                'id' => $item->id,
                'collection_id' => $item->collectionId,
                'name' => $item->name,
                'buildingType' => $item->buildingType
            );
            $building[] = $object2;
        }
        $apartments = Apartment::all();
        $apartment = [];
        foreach ($apartments as $item) {
            $currentHousingApartment = \count(DB::table('housings')->where('approve', 3)->where('apartmentId', $item->id)->get());
            $object3 = array(
                'id' => $item->id,
                "apartment_id" => $item->buildingId,
                'name' => $item->apartmentNum,
                'floor_number' => $item->floorNum,
                'people_number' => $currentHousingApartment
            );
            $apartment[] = $object3;
        }
        $rooms = Room::all();
        $room = [];
        foreach ($rooms as $item) {
            $currentHousingRoom = \count(DB::table('housings')->where('approve', 3)->where('roomId', $item->id)->get());
            $object4 = array(
                'id' => $item->id,
                "room_id" => $item->apartmentNum,
                'room_name' => $item->roomNum,
                'Floor_number' => $item->floorNum,
                'people_number' => $currentHousingRoom
            );
            $room[] = $object4;
        }
        $housings = DB::table('housings')->where('approve', 3)->get();
        $housing = [];
        foreach ($housings as $item) {
            $worker = DB::table('data')->where('num', $item->empId)->first();
            $object4 = array(
                'id' => $item->id,
                'room_id' => $item->roomId,
                'worker_id' => $worker->idNum,
                'worker_number' => $worker->num,
                'worker_name' => $worker->name,
                'worker_national' => $worker->nationality,
                'worker_name_job' => $worker->job,
                'worker_Status' => $item->status,
                'worker_site' => $worker->city,
                'worker_project' => $worker->location,
                'unit_id' => $item->buildingId,
            );
            $housing[] = $object4;
        }
        return view('housing.index')->with('coll', $coll)
            ->with('building', $building)->with('apartment', $apartment)
            ->with('room', $room)->with('housing', $housing);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = DB::table('region')->get();
        $value = DB::table('values')->get();
        $status = DB::table('statuses')->get();
        $room = DB::table('rooms')->get();
        $apartment = DB::table('apartments')->get();
        $building = DB::table('buildings')->where('approve', 3)->get();
        $coll = DB::table('collections')->where('approve', 2)->get();
        $data = DB::table('data')->get();
        return view('housing.create')->with('data', $data)
            ->with('coll', $coll)->with('building', $building)
            ->with('apartment', $apartment)->with('room', $room)
            ->with('status', $status)->with('value', $value)
            ->with('region', $region);
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
            'region' => 'required|string',
            'city' => 'required|string',
            'collectionId' => 'required|string',
            'buildingId' => 'required|string',
            'apartmentId' => 'string',
            'roomId' => 'required|string',
            'status' => 'required|string',
            'date' => 'required|string',
            'type' => 'required|string',
        ]);
        $currentHousing = DB::table('housings')->where('approve', 3)->where('empId', $request->empId)->first();
        if ($currentHousing != null) {
            return \back()->with('rr', 'rr');
        }
        if ($request->roomId) {
            $roomJoinHousing = \count(DB::table('housings')->where('approve', 3)->where('roomId', '=', $request->roomId)->get());
            $room = DB::table('rooms')->where('id', '=', $request->roomId)->first();
            if ($roomJoinHousing >= $room->count) {
                return redirect()->back()->with('ll', 'll');
            }
        }
        $housing = new Housing();
        $housing->empId = $request->empId;
        $housing->empName = $request->empName;
        $housing->empNumId = $request->empNumId;
        $housing->region = $request->region;
        $housing->city = $request->city;
        $housing->collectionId = $request->collectionId;
        $housing->buildingId = $request->buildingId;
        $housing->apartmentId = $request->apartmentId;
        $housing->roomId = $request->roomId;
        $housing->status = $request->status;
        $housing->date = $request->date;
        $housing->type = $request->type;
        if (auth()->user()->type == 1) {
            $housing->approve = 3;
        } elseif (auth()->user()->type == 2) {
            $housing->approve = 2;
        }
        $housing->save();
        return redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function show(Housing $housing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function edit(Housing $housing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Housing $housing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $housing = Housing::find($id);
        $housing->delete();
        return back()->with('done', 'done');
    }

    public function approve($id)
    {
        $Housing = Housing::find($id);
        $Housing->approve += 1;
        $Housing->save();
        return redirect()->back()->with('done', 'done');
    }

    public function notApprove($id)
    {
        $Housing = Housing::find($id);
        $Housing->approve = 0;
        $Housing->save();
        return redirect()->back()->with('done', 'done');
    }

    public function again($id)
    {
        $Housing = Housing::find($id);
        $Housing->approve = 1;
        $Housing->save();
        return redirect()->back()->with('done', 'done');
    }
}

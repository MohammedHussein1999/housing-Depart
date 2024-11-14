<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coll = DB::table('collections')->where('approve', 2)->with(['city', 'region'])->get();
        $building = DB::table('buildings')->where('approve', 3)->with(['city', 'region'])->get();
        $colll = [];
        $build = [];
        if (auth()->user()->type == 1) {
            foreach ($coll as $item) {
                $count = count(DB::table('housings')->where('approve', 3)->where('collectionId', '=', $item->id)->get());
                $object = array(
                    'id' => $item->id,
                    'city' => $item->city,
                    'region' => $item->region,
                    'name' => $item->name,
                    'count' => $item->count,
                    'active' => $item->active,
                    'currentCount' => $count,
                );

                $colll[] = $object;
            }
            foreach ($building as $item) {
                $count2 = count(DB::table('housings')->where('approve', 3)->where('buildingId', '=', $item->id)->get());
                $object2 = array(
                    'id' => $item->id,
                    'collectionId' => $item->collectionId,
                    'city' => $item->city,
                    'region' => $item->region,
                    'name' => $item->name,
                    'buildingType' => $item->buildingType,
                    'active' => $item->active,
                    'count' => $count2,
                );
                $build[] = $object2;
            }
            $room = DB::table('collections')->get();
            $apartment = DB::table('collections')->get();
        } else if (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $collection = [];
            foreach ($phpArray as $item) {
                $collections = DB::table('collections')->where('approve', 2)->where('region', $item)->get();
                $buildings = DB::table('buildings')->where('approve', 3)->where('region', $item)->get();
                $apartments = DB::table('joinapartment')->where('region', $item)->get();
                $apartment = [];
                $rooms = DB::table('joinroom')->where('region', $item)->get();
                $room = [];
                foreach ($rooms as $item) {
                    $object5 = [
                        'id' => $item->id,
                        'roomNum' => $item->roomNum,
                        'floorNum' => $item->floorNum,
                        'active' => $item->active,
                        'collectionId' => $item->collectionId,
                        'collName' => $item->collName,
                        'region' => $item->region,
                        'apartmentNum' => $item->apartmentNum,
                        'buildingName' => $item->buildingName,
                    ];
                    $room[] = $object5;
                }
                foreach ($apartments as $item) {
                    $object4 = [
                        'id' => $item->id,
                        'apartmentNum' => $item->apartmentNum,
                        'floorNum' => $item->floorNum,
                        'active' => $item->active,
                        'collectionId' => $item->collectionId,
                        'collName' => $item->collName,
                        'region' => $item->region,
                        'buildingName' => $item->buildingName,
                    ];
                    $apartment[] = $object4;
                }
                foreach ($collections as $item) {
                    $count = count(DB::table('housings')->where('approve', 3)->where('collectionId', '=', $item->id)->get());
                    $object = array(
                        'id' => $item->id,
                        'city' => $item->city,
                        'region' => $item->region,
                        'name' => $item->name,
                        'count' => $item->count,
                        'active' => $item->active,
                        'currentCount' => $count,
                    );
                    $colll[] = $object;
                }
                foreach ($buildings as $item) {
                    $count2 = count(DB::table('housings')->where('approve', 3)->where('buildingId', '=', $item->id)->get());
                    $object2 = array(
                        'id' => $item->id,
                        'collectionId' => $item->collectionId,
                        'city' => $item->city,
                        'region' => $item->region,
                        'name' => $item->name,
                        'buildingType' => $item->buildingType,
                        'active' => $item->active,
                        'count' => $count2,
                    );
                    $build[] = $object2;
                }
            }
        } else if (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            foreach ($phpArray as $item) {
                $collections = DB::table('collections')->where('approve', 2)->where('id', $item)->get();
                $buildings = DB::table('buildings')->where('approve', 3)->where('collectionId', $item)->get();
                $apartments = DB::table('joinapartment')->where('collectionId', $item)->get();
                $apartment = [];
                $rooms = DB::table('joinroom')->where('collectionId', $item)->get();
                $room = [];
                foreach ($rooms as $item) {
                    $object5 = [
                        'id' => $item->id,
                        'roomNum' => $item->roomNum,
                        'floorNum' => $item->floorNum,
                        'active' => $item->active,
                        'collectionId' => $item->collectionId,
                        'collName' => $item->collName,
                        'region' => $item->region,
                        'apartmentNum' => $item->apartmentNum,
                        'buildingName' => $item->buildingName,
                    ];
                    $room[] = $object5;
                }
                foreach ($apartments as $item) {
                    $object4 = [
                        'id' => $item->id,
                        'apartmentNum' => $item->apartmentNum,
                        'floorNum' => $item->floorNum,
                        'active' => $item->active,
                        'collectionId' => $item->collectionId,
                        'collName' => $item->collName,
                        'region' => $item->region,
                        'buildingName' => $item->buildingName,
                    ];
                    $apartment[] = $object4;
                }
                foreach ($collections as $item) {
                    $count = count(DB::table('housings')->where('approve', 3)->where('collectionId', '=', $item->id)->get());
                    $object = array(
                        'id' => $item->id,
                        'city' => $item->city,
                        'region' => $item->region,
                        'name' => $item->name,
                        'count' => $item->count,
                        'active' => $item->active,
                        'currentCount' => $count,
                    );
                    $colll[] = $object;
                }
                foreach ($buildings as $item) {
                    $count2 = count(DB::table('housings')->where('approve', 3)->where('buildingId', '=', $item->id)->get());
                    $object2 = array(
                        'id' => $item->id,
                        'collectionId' => $item->collectionId,
                        'city' => $item->city,
                        'region' => $item->region,
                        'name' => $item->name,
                        'buildingType' => $item->buildingType,
                        'active' => $item->active,
                        'count' => $count2,
                    );
                    $build[] = $object2;
                }
            }
        }
            
        return  view('collections.collections')->with('coll', $coll)->with('colll', $colll)
            ->with('building', $building)->with('apartment', $apartment)
            ->with('room', $room)->with('build', $build);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->type == 3) {
            return back();
        }
        $region = DB::table('collections')->get();
        return view('collections.create')->with('region', $region);
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
            'name' => 'required|string',
            'location' => 'required|string',
        ]);
        $collection = new Collection();
        $collection->city = $request->city;
        $collection->region = $request->region;
        $collection->name = $request->name;
        $collection->location = $request->location;
        $collection->count = $request->count;
        if ($request->file("file") != null) {
            $collection_data = $request->file("file");
            $collection_name = \time() . $collection_data->getClientOriginalName();
            $location =  \public_path('./PDF folder/');
            $collection_data->move($location, $collection_name);
            $collection->file = $collection_name;
        }
        if ($request->active == 1) {
            $collection->active = $request->active;
        } else {
            $collection->active = 0;
        }
        $collection->attach = $request->attach;
        if (auth()->user()->type == 1) {
            $collection->approve = 2;
        }
        $collection->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coll = Collection::find($id);
        return view('collections.editColl')->with('coll', $coll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);
        $collection = Collection::find($id);
        if ($request->city != null) {
            $collection->city = $request->city;
        }
        if ($request->region != null) {
            $collection->region = $request->region;
        }
        $collection->name = $request->name;
        $collection->location = $request->location;
        $collection->count = $request->count;
        if ($request->file("file") != null) {
            if ($collection->file != null) {
                $path = \public_path() . "/PDF folder/" . $collection->file;
                \unlink($path);
                $collection_data = $request->file("file");
                $collection_name = \time() . $collection_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $collection_data->move($location, $collection_name);
                $collection->file = $collection_name;
            } else {
                $collection_data = $request->file("file");
                $collection_name = \time() . $collection_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $collection_data->move($location, $collection_name);
                $collection->file = $collection_name;
            }
        }
        if ($request->active == 1) {
            $collection->active = $request->active;
        } else {
            $collection->active = 0;
        }
        $collection->attach = $request->attach;
        $collection->save();
        return \redirect()->route('collection.index')->with('done', 'done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coll = Collection::find($id);
        $building = DB::table('buildings')->where('collectionId', '=', $coll->id)->first();
        if ($building != null) {
            return \redirect()->back()->with('remove', 'remove');
        }
        if ($coll->file != null) {
            $path = \public_path() . "/PDF folder/" . $coll->file;
            \unlink($path);
            $coll->file = null;
        }
        $coll->delete();
        return redirect()->back()->with('done', 'done');
    }

    public function active($id)
    {
        $coll = Collection::find($id);
        if ($coll->active == 1) {
            $coll->active = 2;
            $coll->save();
        } else {
            $coll->active = 1;
            $coll->save();
        }
        return redirect()->back()->with('done', 'done');
    }

    public function download($id)
    {
        $drive = Collection::find($id);
        $drive_name = $drive->file;
        $path = \public_path() . "/PDF folder/" . $drive_name;
        return \response()->download($path);
    }

    public function approve($id)
    {
        $coll = Collection::find($id);
        $coll->approve = 2;
        $coll->save();
        return redirect()->back()->with('done', 'done');
    }

    public function notApprove($id)
    {
        $coll = Collection::find($id);
        $coll->approve = 0;
        $coll->save();
        return redirect()->back()->with('done', 'done');
    }

    public function again($id)
    {
        $coll = Collection::find($id);
        $coll->approve = 1;
        $coll->save();
        return redirect()->back()->with('done', 'done');
    }
}

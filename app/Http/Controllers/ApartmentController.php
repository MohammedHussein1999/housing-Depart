<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\ErrorHandler\Collecting;

class ApartmentController extends Controller
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
        $region = DB::table('buildings')->get();
        $building = DB::table('buildings')->where('buildingType','!=','كبينة')->where('approve',3)->get();
        $collection = DB::table('collections')->where('approve',2)->get();
        return view('collections.apartmentCreate')->with('collection', $collection)
            ->with('building', $building)->with('region',$region);
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
            'floorNum' => 'required|string',
        ]);
        $apartment = new Apartment();
        $apartment->collectionId = $request->collectionId;
        $apartment->buildingId = $request->buildingId;
        $apartment->floorNum = $request->floorNum;
        $apartment->apartmentNum = $request->apartmentNum;
        $apartment->bathroomCount = $request->bathroomCount;
        $apartment->electricity = $request->electricity;
        $apartment->accountNum = $request->accountNum;
        if ($request->file("file") != null) {
            $apartment_data = $request->file("file");
            $apartment_name = \time() . $apartment_data->getClientOriginalName();
            $location =  \public_path('./PDF folder/');
            $apartment_data->move($location, $apartment_name);
            $apartment->file = $apartment_name;
        }
        if ($request->active == 1) {
            $apartment->active = $request->active;
        }else{
            $apartment->active = 0;
        }
        $apartment->attach = $request->attach;
        $apartment->other = $request->other;
        $apartment->save();
        return \redirect()->back()->with('done','done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coll = Collection::all();
        $building = Building::all();
        $apartment = Apartment::find($id);
        return view('collections.editApartment')->with('apartment',$apartment)
        ->with('coll',$coll)->with('building',$building);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'apartmentNum' => 'required|string',
            'floorNum' => 'required|string',
        ]);
        $apartment = Apartment::find($id);
        if ($request->collectionId != null){
            $apartment->collectionId = $request->collectionId;
        }
        if ($request->buildingId != null){
            $apartment->buildingId = $request->buildingId;
        }
        $apartment->floorNum = $request->floorNum;
        $apartment->apartmentNum = $request->apartmentNum;
        $apartment->bathroomCount = $request->bathroomCount;
        $apartment->electricity = $request->electricity;
        $apartment->accountNum = $request->accountNum;
        if ($request->file("file") != null) {
            if ($apartment->file != null) {
                $path = \public_path() . "/PDF folder/" . $apartment->file;
                \unlink($path);
                $apartment_data = $request->file("file");
                $apartment_name = \time() . $apartment_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $apartment_data->move($location, $apartment_name);
                $apartment->file = $apartment_name;
            } else {
                $apartment_data = $request->file("file");
                $apartment_name = \time() . $apartment_data->getClientOriginalName();
                $location =  \public_path('./PDF folder/');
                $apartment_data->move($location, $apartment_name);
                $apartment->file = $apartment_name;
            }
        }
        $apartment->active = $apartment->active;
        $apartment->attach = $request->attach;
        $apartment->other = $request->other;
        $apartment->save();
        return \redirect()->route('collection.index')->with('done','done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $room = DB::table('rooms')->where('apartmentNum','=',$apartment->id)->first();
        if($room != null){
            return \redirect()->back()->with('remove','remove');
        }
        if ($apartment->file != null) {
            $path = \public_path() . "/PDF folder/" . $apartment->file;
            \unlink($path);
            $apartment->file = null;
        }
        $apartment->delete();
        return redirect()->back()->with('done','done');
    }

    public function active($id)
    {
        $apartment = Apartment::find($id);
        if($apartment->active == 1){
            $apartment->active = 2;
            $apartment->save();
        }else{
            $apartment->active = 1;
            $apartment->save();
        }
        return redirect()->back()->with('done','done');
    }

    public function download($id)
    {
        $drive = Apartment::find($id);
        $drive_name = $drive->file;
        $path = \public_path() . "/PDF folder/" . $drive_name;
        return \response()->download($path);
    }
}

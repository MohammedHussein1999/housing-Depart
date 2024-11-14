<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class reportController extends Controller
{

    public function nationality()
    {
        $nationalitys = DB::table('nationality')->get();
        $nationality = [];
        if (auth()->user()->type == 1) {
            foreach ($nationalitys as $item) {
                $count = count(DB::table('reportdata')->where('empNationality', $item->nationality)->get());
                $object = array(
                    'name' => $item->nationality,
                    'count' => $count,
                );
                $nationality[] = $object;
            }
            $housing = count(DB::table('reportdata')->get());
        } elseif (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            foreach ($nationalitys as $item) {
                $count = 0;
                $housing = 0;
                foreach ($phpArray as $item2) {
                    $housings = count(DB::table('reportdata')->where('region', $item2)->get());
                    $counts = count(DB::table('reportdata')->where('region', $item2)->where('empNationality', $item->nationality)->get());
                    $count = +$counts;
                    $housing = +$housings;
                }
                $object = array(
                    'name' => $item->nationality,
                    'count' => $count,
                );
                $nationality[] = $object;
            }
        } elseif (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            foreach ($nationalitys as $item) {
                $count = 0;
                $housing = 0;
                foreach ($phpArray as $item2) {
                    $collection = DB::table('collections')->where('id', $item2)->first();
                    $housings = count(DB::table('reportdata')->where('collectionName', $collection->name)->get());
                    $counts = count(DB::table('reportdata')->where('collectionName', $collection->name)->where('empNationality', $item->nationality)->get());
                    $count = +$counts;
                    $housing = +$housings;
                }
                $object = array(
                    'name' => $item->nationality,
                    'count' => $count,
                );
                $nationality[] = $object;
            }
        }
        return \view('reports.nationality')->with('nationality', $nationality)
            ->with('housing', $housing);
    }

    public function location()
    {
        if (auth()->user()->type == 1) {
            $location = DB::table('reportdata')
                ->select('empLocation', DB::raw('COUNT(*) as count'), DB::raw('SUM(value) as total_value'))
                ->where('approve', 3)
                ->groupBy('empLocation')
                ->get();
            $valuess = DB::table('reportdata')->where('approve', 3)->sum('value');
            $housing = count(DB::table('reportdata')->where('approve', 3)->get());
        } elseif (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $location = [];
            $valuess = 0;
            $housing = 0;
            foreach ($phpArray as $item) {
                $locations = DB::table('reportdata')
                    ->select('empLocation', DB::raw('COUNT(*) as count'), DB::raw('SUM(value) as total_value'))
                    ->where('approve', 3)
                    ->where('region', $item)
                    ->groupBy('empLocation')
                    ->get();
                foreach ($locations as $item) {
                    $object = array(
                        'empLocation' => $item->empLocation,
                        'count' => $item->count,
                        'total_value' => $item->total_value,
                    );
                    $location[] = $object;
                    $valuess += $item->total_value;
                    $housing += $item->count;
                }
            }
        } elseif (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $location = [];
            $valuess = 0;
            $housing = 0;
            foreach ($phpArray as $item) {
                $collection = DB::table('collections')->where('id', $item)->first();
                $locations = DB::table('reportdata')
                    ->select('empLocation', DB::raw('COUNT(*) as count'), DB::raw('SUM(value) as total_value'))
                    ->where('approve', 3)
                    ->where('collectionName', $collection->name)
                    ->groupBy('empLocation')
                    ->get();
                foreach ($locations as $item) {
                    $object = array(
                        'empLocation' => $item->empLocation,
                        'count' => $item->count,
                        'total_value' => $item->total_value,
                    );
                    $location[] = $object;
                    $valuess += $item->total_value;
                    $housing += $item->count;
                }
            }
        }

        return \view('reports.location')->with('location', $location)
            ->with('housing', $housing)->with('value', $valuess);
    }

    public function full()
    {
        $coll = DB::table('collections')->where('approve', 2)->get();
        $location = DB::table('location')->get();
        $nationality = DB::table('nationality')->get();
        if (auth()->user()->type == 1) {
            $data = DB::table('reportdata')->where('approve', 3)->get();
        } elseif (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $data = [];
            foreach ($phpArray as $item) {
                $dataa = DB::table('reportdata')->where('region', $item)->where('approve', 3)->get();
                foreach ($dataa as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empNum' => $item->empNum,
                        'empName' => $item->empName,
                        'empJob' => $item->empJob,
                        'empCity' => $item->empCity,
                        'empLocation' => $item->empLocation,
                        'empNationality' => $item->empNationality,
                        'region' => $item->region,
                        'cityId' => $item->cityId,
                        'date' => $item->date,
                        'value' => $item->value,
                        'collectionName' => $item->collectionName,
                        'unitName' => $item->unitName,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'approve' => $item->approve,
                    );
                    $data[] = $object;
                }
            }
        } elseif (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $data = [];
            foreach ($phpArray as $item) {
                $collection = DB::table('collections')->where('id', $item)->first();
                $dataa = DB::table('reportdata')->where('collectionName', $collection->name)->where('approve', 3)->get();
                foreach ($dataa as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empNum' => $item->empNum,
                        'empName' => $item->empName,
                        'empJob' => $item->empJob,
                        'empCity' => $item->empCity,
                        'empLocation' => $item->empLocation,
                        'empNationality' => $item->empNationality,
                        'region' => $item->region,
                        'cityId' => $item->cityId,
                        'date' => $item->date,
                        'value' => $item->value,
                        'collectionName' => $item->collectionName,
                        'unitName' => $item->unitName,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'approve' => $item->approve,
                    );
                    $data[] = $object;
                }
            }
        }
        return view('reports.full', [
            'coll' => $coll,
            'location' => $location,
            'nationality' => $nationality,
            'data' => $data
        ]);
    }

    public function out()
    {
        if (auth()->user()->type == 1) {
            $out = DB::table('outreport')->where('approve', 3)->get();
        } elseif (auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $out = [];
            foreach ($phpArray as $item) {
                $region = DB::table('region')->where('id', $item)->first();
                $outs = DB::table('outreport')->where('region', $region->name)->where('approve', 3)->get();
                foreach ($outs as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empNum' => $item->empNum,
                        'empName' => $item->empName,
                        'empJob' => $item->empJob,
                        'empCity' => $item->empCity,
                        'empLocation' => $item->empLocation,
                        'empNationality' => $item->empNationality,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collection' => $item->collection,
                        'building' => $item->building,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'status' => $item->status,
                        'housingDate' => $item->housingDate,
                        'outDate' => $item->outDate,
                        'reason' => $item->reason,
                        'approve' => $item->approve,
                    );
                    $out[] = $object;
                }
            }
        } elseif (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $out = [];
            foreach ($phpArray as $item) {
                $collection = DB::table('collections')->where('id', $item)->first();
                $outs = DB::table('outreport')->where('collection', $collection->name)->where('approve', 0)->get();
                foreach ($outs as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empNum' => $item->empNum,
                        'empName' => $item->empName,
                        'empJob' => $item->empJob,
                        'empCity' => $item->empCity,
                        'empLocation' => $item->empLocation,
                        'empNationality' => $item->empNationality,
                        'region' => $item->region,
                        'city' => $item->city,
                        'collection' => $item->collection,
                        'building' => $item->building,
                        'apartmentNum' => $item->apartmentNum,
                        'roomNum' => $item->roomNum,
                        'status' => $item->status,
                        'housingDate' => $item->housingDate,
                        'outDate' => $item->outDate,
                        'reason' => $item->reason,
                        'approve' => $item->approve,
                    );
                    $out[] = $object;
                }
            }
        }
        return view('reports.out')->with('out', $out);
    }
    
    public function room()
    {
        $coll = DB::table('collections')->get();
        $rooms = DB::table('joinroom')->get();
        $room = [];
        $value = 0;
        foreach ($rooms as $item) {
            $currentHousingRoom = \count(DB::table('housings')->where('approve', 3)->where('roomId', $item->id)->get());
            if ($currentHousingRoom == 0) {
                $object = array(
                    'id' => $item->id,
                    'roomNum' => $item->roomNum,
                    'collectionId' => $item->collName,
                    'buildingId' => $item->buildingName,
                    'apartmentNum' => $item->apartmentNum,
                    'floorNum' => $item->floorNum,
                    'count' => $item->count,
                );
                $room[] = $object;
                $value += 1;
            }
        }
        return view('reports.room', ['room' => $room, 'value' => $value, 'coll' => $coll]);
    }
}

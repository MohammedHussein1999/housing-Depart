<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function coll()
    {
        if (\auth()->user()->type == 1) {
            $coll = DB::table('collections')->where('approve', 1)->get();
        } else if (\auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $coll = [];
            foreach ($phpArray as $item) {
                $collection = DB::table('collections')->where('region', $item)->where('approve', 0)->get();
                foreach ($collection as $item) {
                    $object = array(
                        'id' => $item->id,
                        'city' => $item->city,
                        'region' => $item->region,
                        'name' => $item->name,
                        'count' => $item->count,
                        'active' => $item->active,
                        'approvee' => $item->approve,
                    );
                    $coll[] = $object;
                }
            }
        } else {
            return back();
        }
        return view('notifications.coll', [
            'coll' => $coll,
        ]);
    }

    public function building()
    {
        if (\auth()->user()->type == 1) {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $building = DB::table('buildings')->where('approve', 2)->get();
        } else if (\auth()->user()->type == 2) {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $phpArray = json_decode(auth()->user()->attach, true);
            $building = [];
            foreach ($phpArray as $item) {
                $buildings = DB::table('buildings')->where('region', $item)->where('approve', 1)->get();
                foreach ($buildings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'name' => $item->name,
                        'collectionId' => $item->collectionId,
                        'city' => $item->city,
                        'region' => $item->region,
                        'approvee' => $item->approve,
                    );
                    $building[] = $object;
                }
            }
        } else {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $phpArray = json_decode(auth()->user()->attach, true);
            $building = [];
            foreach ($phpArray as $item) {
                $buildings = DB::table('buildings')->where('collectionId', $item)->where('approve', 0)->get();
                foreach ($buildings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'name' => $item->name,
                        'collectionId' => $item->collectionId,
                        'city' => $item->city,
                        'region' => $item->region,
                        'approvee' => $item->approve,
                    );
                    $building[] = $object;
                }
            }
        }
        return view('notifications.building', [
            'building' => $building,
            'coll' => $coll,
        ]);
    }

    public function housing()
    {
        if (\auth()->user()->type == 1) {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $building = DB::table('buildings')->where('approve', 3)->get();
            $housing = DB::table('housings')->where('approve', 2)->get();
        } else if (\auth()->user()->type == 2) {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $phpArray = json_decode(auth()->user()->attach, true);
            $building = DB::table('buildings')->where('approve', 3)->get();
            $housing = [];
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('region', $item)->where('approve', 1)->get();
                foreach ($housings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empName' => $item->empName,
                        'empId' => $item->empId,
                        'collectionId' => $item->collectionId,
                        'buildingId' => $item->buildingId,
                        'type' => $item->type,
                        'date' => $item->date,
                        'approvee' => $item->approve,
                    );
                    $housing[] = $object;
                }
            }
        } else {
            $coll = DB::table('collections')->where('approve', 2)->get();
            $phpArray = json_decode(auth()->user()->attach, true);
            $building = DB::table('buildings')->where('approve', 3)->get();
            $housing = [];
            foreach ($phpArray as $item) {
                $housings = DB::table('housings')->where('collectionId', $item)->where('approve', 0)->get();
                foreach ($housings as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empName' => $item->empName,
                        'empId' => $item->empId,
                        'collectionId' => $item->collectionId,
                        'buildingId' => $item->buildingId,
                        'type' => $item->type,
                        'date' => $item->date,
                        'approvee' => $item->approve,
                    );
                    $housing[] = $object;
                }
            }
        }
        return view('notifications.housing', [
            'building' => $building,
            'coll' => $coll,
            'housing' => $housing,
        ]);
    }

    public function out()
    {
        if (\auth()->user()->type == 1) {
            $out = DB::table('outs')->where('approve', 2)->get();
        } elseif (\auth()->user()->type == 2) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $out = [];
            foreach ($phpArray as $item) {
                $region = DB::table('region')->where('id', $item)->first();
                $outs = DB::table('outs')->where('region', $region->name)->where('approve', 1)->get();
                foreach ($outs as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empName' => $item->empName,
                        'empId' => $item->empId,
                        'housingDate' => $item->housingDate,
                        'outDate' => $item->outDate,
                        'reason' => $item->reason,
                    );
                    $out[] = $object;
                }
            }
        } elseif (auth()->user()->type == 3) {
            $phpArray = json_decode(auth()->user()->attach, true);
            $out = [];
            foreach ($phpArray as $item) {
                $collection = DB::table('collections')->where('id', $item)->first();
                $outs = DB::table('outs')->where('collection', $collection->name)->where('approve', 0)->get();
                foreach ($outs as $item) {
                    $object = array(
                        'id' => $item->id,
                        'empName' => $item->empName,
                        'empId' => $item->empId,
                        'housingDate' => $item->housingDate,
                        'outDate' => $item->outDate,
                        'reason' => $item->reason,
                    );
                    $out[] = $object;
                }
            }
        }
        return view('notifications.out', [
            'out' => $out
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
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
        $clientStatus = DB::table('statuses')->get();
        return view('setting.client')->with('clientStatus',$clientStatus);
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
        $status = new Status();
        $status->name = $request->name;
        $status->status = 1;
        $status->active = 1;
        $status->save();
        return \redirect()->back()->with('done','done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect()->back()->with('done','done');
    }
    public function active($id)
    {
        $status = Status::find($id);
        if($status->active == 1){
            $status->active = 2;
            $status->save();
        }else{
            $status->active = 1;
            $status->save();
        }
        return redirect()->back()->with('done','done');
    }
    public function status($id)
    {
        $status = Status::find($id);
        if($status->status == 1){
            $status->status = 2;
            $status->save();
        }else{
            $status->status = 1;
            $status->save();
        }
        return redirect()->back()->with('done','done');
    }
}

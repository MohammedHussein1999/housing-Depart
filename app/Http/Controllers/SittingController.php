<?php

namespace App\Http\Controllers;

use App\Models\Sitting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SittingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomStatus = DB::table('rooms_statuses')->get();
        return view('setting.index')->with('roomStatus', $roomStatus);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function show(Sitting $sitting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitting $sitting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sitting $sitting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitting $sitting)
    {
        //
    }
}

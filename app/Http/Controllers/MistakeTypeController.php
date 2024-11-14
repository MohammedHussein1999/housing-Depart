<?php

namespace App\Http\Controllers;

use App\Models\MistakeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MistakeTypeController extends Controller
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
        $mistake = DB::table('mistake_types')->get();
        return view('setting.mistake')->with('mistake', $mistake);
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
        $mistake = new MistakeType();
        $mistake->name = $request->name;
        $mistake->active = 1;
        $mistake->save();
        return \redirect()->back()->with('done', 'done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MistakeType  $mistakeType
     * @return \Illuminate\Http\Response
     */
    public function show(MistakeType $mistakeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MistakeType  $mistakeType
     * @return \Illuminate\Http\Response
     */
    public function edit(MistakeType $mistakeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MistakeType  $mistakeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MistakeType $mistakeType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MistakeType  $mistakeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = MistakeType::find($id);
        $room->delete();
        return redirect()->back()->with('done', 'done');
    }
    public function active($id)
    {
        $mistake = MistakeType::find($id);
        if ($mistake->active == 1) {
            $mistake->active = 2;
            $mistake->save();
        } else {
            $mistake->active = 1;
            $mistake->save();
        }
        return redirect()->back()->with('done', 'done');
    }
}

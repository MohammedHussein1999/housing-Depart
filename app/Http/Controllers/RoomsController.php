<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Rooms;
// use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function create(RoomRequest $request)
    {

        Rooms::create($request->all());
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
// use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create(UnitRequest $request)
    {

        Unit::create($request->all());
        return redirect()->back();
    }
}

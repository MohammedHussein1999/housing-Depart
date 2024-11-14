<?php

namespace App\Http\Controllers;

use App\Models\ApartmentNew;
use Illuminate\Http\Request;

class ApartmentNewController extends Controller
{
    public function create(Request $request)
    {

        ApartmentNew::create($request->all());
        return redirect()->back();
        // return response($request);
    }
}

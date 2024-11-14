<?php

namespace App\Http\Controllers;

// use App\Models\City;
use App\Models\Collection;
// use App\Models\Region;

// use Illuminate\Http\Request;


class CollectionControllerA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collNew = Collection::get();

        return response( ["data" => $collNew]);
    }
}

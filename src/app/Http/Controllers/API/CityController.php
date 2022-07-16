<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities()
    {
        $cities = City::all();

        return response()->json($cities);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchCity(Request $request)
    {
        $cities = City::where('name', 'like', '%' . $request->words . '%')->get();

        return response()->json($cities);
    }
}

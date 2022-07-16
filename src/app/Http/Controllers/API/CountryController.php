<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function getCountries()
    {
        return CountryResource::collection(Country::all());
    }
}

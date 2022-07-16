<?php

namespace App\Http\Controllers\API;

use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getTypes()
    {
        $types = Type::all();

        return response()->json($types);
    }
}

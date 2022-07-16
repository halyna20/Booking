<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Apartment\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
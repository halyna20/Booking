<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Apartment\ApartmentRequest;
use App\Http\Requests\Apartment\GetApartmentRequest;
use App\Http\Requests\Apartment\SearchRequest;
use App\Http\Resources\Apartment\ApartmentCollection;
use App\Http\Resources\Apartment\ApartmentResource;
use App\Models\Apartment;
use App\Models\Room;
use App\Services\Apartment\Service;

class ApartmentController extends BaseController
{
    protected Apartment $apartment;
    protected Room $room;
    protected Service $apartmentService;

    public function __construct(Apartment $apartment, Room $room, Service $apartmentService)
    {
        $this->apartment = $apartment;
        $this->room = $room;
        $this->apartmentService = $apartmentService;
    }

    public function search(SearchRequest $request)
    {
        $data = $request->validated();
        $getSearchValue = $this->apartmentService->search($data);

        return count($getSearchValue) !== 0 ? new ApartmentCollection($getSearchValue)
            : response()->json(['error' => 'За вашим запитом нічого не знайдено']);
    }

    public function getApartmentById(Apartment $apartment, GetApartmentRequest $request)
    {
        $data = $request->validated();
        $getRoom = $this->apartmentService->getApartmentById($apartment->id, $data);

        return response()->json(['apartment' => new ApartmentResource($apartment), 'rooms' => $getRoom]);
    }

    public function store(ApartmentRequest $request)
    {
        $data = $request->validated();
        $apartment = $this->apartmentService->store($data);
        return new ApartmentResource($apartment);
    }
}

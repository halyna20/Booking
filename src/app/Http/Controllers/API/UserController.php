<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\Apartment\ApartmentResource;
use App\Http\Resources\Booking\BookingDateResource;
use App\Http\Resources\User\UserResource;
use App\Models\Apartment;
use App\Models\Room;
use App\Models\User;
use App\Services\User\Service;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(Service $userService)
    {
        $this->userService = $userService;
    }

    public function getAuthorizedUser()
    {
        return  Auth::user() ? new UserResource(Auth::user()) : response()->json(['error' => 'The user is not authorized']);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $this->userService->update($data, $user);

        return new UserResource($user);
    }

    public function getBooking()
    {

        $data = $this->userService->getBooking();

        return $data ? response()->json($data) : response()->json(["message" => "Немає здійснених бронювань"]);
    }
}

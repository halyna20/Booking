<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\API\ApartmentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\RoomController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/store', [ApartmentController::class, 'store']);
    Route::post('/apartment/{apartment}/room/create', [RoomController::class, 'store']);
    Route::post('/booking', [BookingController::class, 'createBooking']);
    Route::delete('/bookingDate/{bookingDate}/delete', [BookingController::class, 'destroy']);
    Route::patch('/user/{user}/update', [UserController::class, 'update']);
    Route::get('/user/booking', [UserController::class, 'getBooking']);
});

Route::get('/search', [ApartmentController::class, 'search']);

Route::get('/apartment/{apartment}', [ApartmentController::class, 'getApartmentById']);


Route::get('/user', [UserController::class, 'getAuthorizedUser']);
Route::get('/types', [TypeController::class, 'getTypes']);
Route::get('/cities', [CityController::class, 'getCities']);
Route::get('/countries', [CountryController::class, 'getCountries']);



Route::middleware('api')->group(function () {
    Route::get('/search-city', [SearchController::class, 'searchCity']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TimeslotsController;
use App\Http\Controllers\API\AdditionalController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/timeslots', [TimeslotsController::class,'index']);
Route::get('/additionals', [AdditionalController::class,'index']);
Route::get('/reservations', [ReservationController::class,'index']);
Route::get('/products', [ProductController::class,'index']);
Route::post('/slotdisponibility', [ReservationController::class,'slotdisponibility']);

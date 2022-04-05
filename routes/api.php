<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TimeslotsController;
use App\Http\Controllers\API\AdditionalController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ExtrasController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SpecialdateController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\ForgotPasswordController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);


Route::get('/timeslots', [TimeslotsController::class,'index']);
Route::get('/additionals', [AdditionalController::class,'index']);
Route::get('/products', [ProductController::class,'index']);
Route::post('/slotdisponibility', [ReservationController::class,'slotdisponibility']);
Route::post('/slotdisponibilityEnd', [ReservationController::class,'slotdisponibilityEnd']);
Route::post('/fulldays', [ReservationController::class,'fulldays']);
Route::post('/slots', [ReservationController::class,'slots']);
Route::get('users/{user}/orders', [UserController::class, 'showOrders']);
Route::post('/extras', [ExtrasController::class,'create']);
Route::post('/reservations', [ReservationController::class,'store']);
Route::post('/adminreservation', [ReservationController::class,'create']);
Route::resource('/reservations', ReservationController::class);
Route::post('/upload-file', [AdditionalController::class,'uploadFile']);
Route::resource('/additionals/', AdditionalController::class);
Route::resource('/spcialdays', SpecialdateController::class);
Route::resource('/groups', GroupController::class);
Route::resource('/checkouts', CheckoutController::class);
Route::resource('/rooms', ProductController::class);
Route::resource('/groups', GroupController::class);
Route::resource('/timeslots', TimeslotsController::class);

Route::resource('/additionals', AdditionalController::class);

Route::post('/fulldaysadmin', [ReservationController::class,'fulldaysadmin']);
Route::get('users/{user}/orders', [UserController::class, 'showOrders']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
//    Route::get('users/{user}/orders', [UserController::class, 'showOrders']);
});




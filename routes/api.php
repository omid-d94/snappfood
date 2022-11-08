<?php

use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\AuthenticationUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//public routes
Route::post("/login", [AuthenticationUserController::class, "login"]);
Route::post("/register", [AuthenticationUserController::class, "store"]);


//private routes
Route::middleware("auth:sanctum")->group(function () {
    Route::post("/logout", [AuthenticationUserController::class, "logout"]);
    Route::resource("addresses", AddressController::class);
    Route::post("/addresses/{address}",[AddressController::class,"setDefaultAddress"]);
});

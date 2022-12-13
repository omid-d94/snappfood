<?php

/* Addresses Routes */

use App\Http\Controllers\User\AddressController;
use Illuminate\Support\Facades\Route;


Route::resource("addresses", AddressController::class);
Route::post("/addresses/{address}", [AddressController::class, "setDefaultAddress"]);
Route::get("/addresses/get/default", [AddressController::class, "getDefaultAddress"])
    ->name("user.addresses.get.default");
Route::put("/addresses/{address}", [AddressController::class, "update"]);
Route::delete("/addresses/{address}", [AddressController::class, "destroy"]);



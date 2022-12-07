<?php

/* Restaurants Routes */

use App\Http\Controllers\User\NearestRestaurantController;
use App\Http\Controllers\User\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::get("/restaurants", [RestaurantController::class, "index"]);///{params?}
Route::get("/restaurants/{restaurant}", [RestaurantController::class, "show"]);

/* Foods of Restaurant Routes */
Route::get("/restaurants/{restaurant}/foods", [RestaurantController::class, "getFoods"]);

/* Find the nearest restaurant */
Route::get("/restaurants/nearest-within-radius/{radius}", [NearestRestaurantController::class, "findNearestRestaurants"])
    ->whereNumber("radius")
    ->name("user.restaurants.find.nearest");


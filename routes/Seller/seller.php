<?php


use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::prefix("seller")->group(function () {

    Route::resource("restaurants", RestaurantController::class)
        ->name("index", "seller.restaurants.index");

    Route::resource("foods", FoodController::class)
        ->name("index", "seller.foods.index");

    Route::get("/restaurants/setting", [RestaurantController::class, "showSetting"])
        ->name("seller.restaurants.setting");

    Route::post("/restaurants/{restaurant}", [RestaurantController::class, "changeSetting"])
        ->name("seller.restaurants.changeSetting");

});

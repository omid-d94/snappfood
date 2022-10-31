<?php


use App\Http\Controllers\admin\FoodController;
use App\Http\Controllers\admin\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::resource('foods', FoodController::class);
    Route::resource('restaurants', RestaurantController::class);

});

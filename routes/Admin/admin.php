<?php


use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as', 'admin.'], function () {

    Route::resource('foods', FoodController::class);
    Route::resource('restaurants', RestaurantController::class);

});

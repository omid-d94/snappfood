<?php


use App\Http\Controllers\admin\FoodCategoryController;
use App\Http\Controllers\admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->group(function () {

    Route::resource('foodCategories', FoodCategoryController::class);
    Route::resource('restaurantCategories', RestaurantCategoryController::class);

});


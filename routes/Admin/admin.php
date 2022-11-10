<?php


use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\FoodCategoryController;
use App\Http\Controllers\admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->middleware(["admin"])->group(function () {

    Route::resource('food-categories', FoodCategoryController::class);
    Route::resource('restaurant-categories', RestaurantCategoryController::class);
    Route::resource("discounts", DiscountController::class);
});


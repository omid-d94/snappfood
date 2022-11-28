<?php


use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\FoodCategoryController;
use App\Http\Controllers\admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->middleware(["admin"])->group(function () {

    Route::resource('food-categories', FoodCategoryController::class);
    Route::resource('restaurant-categories', RestaurantCategoryController::class);
    Route::resource("discounts", DiscountController::class);
    /* Confirms the seller's request to remove comments */
    Route::get("/comments", [CommentController::class, "index"])
        ->name("admin.comments.index");
    Route::delete("/comments/{comment}", [CommentController::class, "deletingConfirm"])
        ->name("admin.comments.confirm.delete");
});


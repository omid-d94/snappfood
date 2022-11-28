<?php


use App\Http\Controllers\Seller\CommentController;
use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::prefix("seller")->middleware(["seller"])->group(function () {

    Route::resource("restaurants", RestaurantController::class)
        ->name("index", "seller.restaurants.index");

    Route::resource("foods", FoodController::class)
        ->name("index", "seller.foods.index");

    Route::get("/restaurants/setting", [RestaurantController::class, "showSetting"])
        ->name("seller.restaurants.setting");

    Route::post("/restaurants/{restaurant}", [RestaurantController::class, "changeSetting"])
        ->name("seller.restaurants.changeSetting");

    /* Seller Dashboard */
    Route::get('/dashboard', [OrderController::class, "getOrders"])
        ->name('seller.dashboard');
    /* Get archived orders */
    Route::get("/orders/archived", [OrderController::class, "getArchivedOrders"])
        ->name("seller.orders.archived");
    /* show order details */
    Route::get("/orders/{order}", [OrderController::class, "showOrder"])
        ->name("seller.orders.show")->whereNumber("order");

    Route::patch("/orders/{order}", [OrderController::class, "updateStatus"])
        ->name("seller.orders.update.status")->whereNumber("order");

    /* comment routes */
    Route::get("/comments", [CommentController::class, "index"])
        ->name("seller.comments.index");
    // Confirm comment
    Route::patch("/comments/{comment}/confirm", [CommentController::class, "confirmComment"])
        ->name("seller.comments.confirm");
    // Reject comment
    Route::patch("/comments/{comment}/reject", [CommentController::class, "rejectComment"])
        ->name("seller.comments.reject");
    // Delete request
    Route::patch("/comments/{comment}/delete", [CommentController::class, "deleteRequest"])
        ->name("seller.comments.delete.request");
    // Replying to comment
    Route::get("/comments/{comment}", [CommentController::class, "ReplyingToComment"])
        ->name("seller.comments.reply");
    // Sending Reply to comment
    Route::PATCH("/comments/{comment}/answer", [CommentController::class, "SendingReply"])
        ->name("seller.comments.sending.reply");
});

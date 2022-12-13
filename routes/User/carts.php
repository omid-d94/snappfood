<?php

/* Food Cart Routes */

use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\User\CartController;
use Illuminate\Support\Facades\Route;


Route::get("/carts", [CartController::class, "getCart"]);
Route::post("/carts/add", [CartController::class, "addToCart"]);
Route::post("/carts/{cart}/pay", [CartController::class, "payForCart"])
    ->whereNumber("cart");
Route::get("/carts/{cart}", [CartController::class, "showCart"]);
Route::patch("/carts/add/{cart}", [CartController::class, "updateCart"])
    ->whereNumber("cart");
Route::delete("/carts/delete/{cart}", [CartController::class, "deleteCart"])
    ->whereNumber("cart");
Route::delete("/carts/{cart}/food/{food}", [CartController::class, "deleteFood"])
    ->whereNumber(["cart", "food"]);

/* Order Tracking by user */
Route::get("/orders/{order}", [OrderController::class, "orderTracking"])
    ->whereNumber("order");


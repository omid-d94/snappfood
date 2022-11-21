<?php

use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\AuthenticationUserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::post("/login", [AuthenticationUserController::class, "login"]);
Route::post("/register", [AuthenticationUserController::class, "store"]);


//private routes
Route::middleware("auth:sanctum")->group(function () {
    /* CRUD User, Logout Routes */
    Route::post("/logout", [AuthenticationUserController::class, "logout"]);
    /* update user */
    Route::put("/update/user/{user}", [AuthenticationUserController::class, "update"])
        ->whereNumber("user")
        ->name("user.update");

    /* delete user */
    Route::delete("/delete/user/{user}", [AuthenticationUserController::class, "destroy"])
        ->whereNumber("user")
        ->name("user.delete");

    /* show user info */
    Route::get("/info/user/{user}", [AuthenticationUserController::class, "show"])
        ->whereNumber("user")
        ->name("user.show");

    /* Addresses Routes */
    Route::resource("addresses", AddressController::class);
    Route::post("/addresses/{address}", [AddressController::class, "setDefaultAddress"]);
    Route::put("/addresses/{address}", [AddressController::class, "update"]);
    Route::delete("/addresses/{address}", [AddressController::class, "destroy"]);

    /* Restaurants Routes */
    Route::get("/restaurants", [RestaurantController::class, "index"]);///{params?}
    Route::get("/restaurants/{restaurant}", [RestaurantController::class, "show"]);

    /* Foods of Restaurant Routes */
    Route::get("/restaurants/{restaurant}/foods", [RestaurantController::class, "getFoods"]);

    /* Food Cart Routes */
    Route::get("/carts", [CartController::class, "getCart"]);
    Route::post("/carts/add", [CartController::class, "addToCart"]);
    Route::post("/carts/{cart}/pay", [CartController::class, "payForCart"])
        ->whereNumber("cart");
    Route::get("/carts/{cart}", [CartController::class, "showCart"]);
    Route::patch("/carts/add/{cart}", [CartController::class, "updateCart"])
        ->whereNumber("cart");
    Route::delete("/carts/delete/{cart}", [CartController::class, "deleteCart"])
        ->whereNumber("cart");
});

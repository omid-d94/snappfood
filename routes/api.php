<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\AuthenticationUserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\NearestRestaurantController;
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

    require_once __DIR__ . "/User/addresses.php";

    require_once __DIR__ . "/User/restaurants.php";

    require_once __DIR__ . "/User/carts.php";

    require_once __DIR__ . "/User/comments.php";

    require_once __DIR__ . "/User/banners.php";

});

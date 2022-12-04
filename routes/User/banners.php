<?php

/* Banners */

use App\Http\Controllers\admin\BannerController;
use Illuminate\Support\Facades\Route;


Route::get("/banners", [BannerController::class, "getBanners"])
    ->name("banners.get");



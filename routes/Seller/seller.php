<?php


use Illuminate\Support\Facades\Route;


Route::middleware(["auth", "userAccess:Seller"])->group(function () {


});

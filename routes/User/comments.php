<?php

/* make a comment on order by user */

use App\Http\Controllers\User\CommentController;
use Illuminate\Support\Facades\Route;


Route::post("/comments", [CommentController::class, "makeComment"]);
/* Get comments group by restaurant or food */
Route::get("/comments", [CommentController::class, "getFoodComments"]);




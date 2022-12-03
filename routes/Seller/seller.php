<?php


use App\Http\Controllers\Seller\CommentController;
use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ReportController;
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

    /* Reports routes */
    // Get reports
    Route::get("/reports", [ReportController::class, "index"])
        ->name("seller.reports.index");
    // Exporting in Excel
    Route::get("/reports/export/excel", [ReportController::class, "exportExcel"])
        ->name("seller.reports.export.excel");
    // Exporting in CSV
    Route::get("/reports/export/csv", [ReportController::class, "exportCSV"])
        ->name("seller.reports.export.csv");
    // Exporting in PDF
    Route::get("/reports/export/pdf", [ReportController::class, "exportPDF"])
        ->name("seller.reports.export.pdf");

    //filter between two dates
    Route::post("/reports/filter-by-date", [ReportController::class, "filterDates"])
        ->name("seller.reports.filter.between");
});

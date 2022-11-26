<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * User Dashboard
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * Admin Dashboard
 */
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['admin',])->name('admin.dashboard');


/**
 * Routes Access By Customer
 */
require __DIR__ . '/User/auth.php';
require __DIR__ . '/User/user.php';

/**
 * Routes Access By Admin
 */
require __DIR__ . '/Admin/auth.php';
require __DIR__ . '/Admin/admin.php';

/**
 * Routes Access By Seller
 */
require __DIR__ . '/Seller/seller.php';
require __DIR__ . '/Seller/auth.php';

Route::get("/mail", function () {
    return view("mails.users.successPayment");
});

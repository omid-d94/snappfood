<?php

use App\Http\Controllers\Seller\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Seller\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Seller\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Seller\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Seller\Auth\NewPasswordController;
use App\Http\Controllers\Seller\Auth\PasswordResetLinkController;
use App\Http\Controllers\Seller\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix("seller")->middleware(['guest:seller'])->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('seller.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('seller.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('seller.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('seller.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('seller.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('seller.password.update');
});

Route::prefix("seller")->middleware(['seller'])->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('seller.verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('seller.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('seller.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('seller.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('seller.logout');
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\SocialAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::get('/google', [SocialAuthController::class, 'redirectToGoogle'])->name('redirect.google');
    Route::get('/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
    Route::get('apple', [SocialAuthController::class, 'redirectToApple']);
    Route::get('apple/callback', [SocialAuthController::class, 'handleAppleCallback']);
});
// ->middleware('auth:sanctum');
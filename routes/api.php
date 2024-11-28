<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\UserSocialAuthCo;
use App\Http\Controllers\API\UserBusinessOwnerInfoCo;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::get('/google', [UserSocialAuthCo::class, 'redirectToGoogle'])->name('redirect.google');
    Route::get('/google/callback', [UserSocialAuthCo::class, 'handleGoogleCallback']);
    Route::get('apple', [UserSocialAuthCo::class, 'redirectToApple']);
    Route::get('apple/callback', [UserSocialAuthCo::class, 'handleAppleCallback']);
});

Route::post('/business-owner-info/store',[UserBusinessOwnerInfoCo::class, 'businessOwnerInfoStore'])->name('businessOwnerInfo.store')->middleware('auth:sanctum');
Route::post('/business-info/store',[UserBusinessOwnerInfoCo::class, 'businessInfoStore'])->name('businessInfo.store')->middleware('auth:sanctum');
// ->middleware('auth:sanctum');
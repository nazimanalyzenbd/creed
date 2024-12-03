<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\UserSocialAuthCo;
use App\Http\Controllers\API\UserBusinessOwnerInfoCo;
use App\Http\Controllers\API\AdminBusinessCo;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::get('/google', [UserSocialAuthCo::class, 'redirectToGoogle'])->name('redirect.google');
    Route::get('/google/callback', [UserSocialAuthCo::class, 'handleGoogleCallback']);
    Route::get('apple', [UserSocialAuthCo::class, 'redirectToApple']);
    Route::get('apple/callback', [UserSocialAuthCo::class, 'handleAppleCallback']);
    Route::post('/manual/sign-up', [UserSocialAuthCo::class, 'manualsignUp']);
    Route::post('/manual/sign-in', [UserSocialAuthCo::class, 'manualLogin']);
});

Route::post('/business-owner-info/store',[UserBusinessOwnerInfoCo::class, 'businessOwnerInfoStore'])->name('businessOwnerInfo.store')->middleware('auth:sanctum');
Route::post('/business-info/store',[UserBusinessOwnerInfoCo::class, 'businessInfoStore'])->name('businessInfo.store')->middleware('auth:sanctum');
Route::get('/business-type', [UserBusinessOwnerInfoCo::class, 'businessType'])->name('business.type');
Route::get('/business-category', [UserBusinessOwnerInfoCo::class, 'businessCategory'])->name('business.category');
Route::get('/business-subcategory', [UserBusinessOwnerInfoCo::class, 'businessSubCategory'])->name('business.subcategory');
Route::get('/business-tags', [UserBusinessOwnerInfoCo::class, 'businessTags'])->name('business.tags');
Route::get('/country-list', [UserBusinessOwnerInfoCo::class, 'countryList'])->name('country.list');
Route::get('/state-list', [UserBusinessOwnerInfoCo::class, 'stateList'])->name('state.list');
Route::get('/city-list', [UserBusinessOwnerInfoCo::class, 'cityList'])->name('city.list');
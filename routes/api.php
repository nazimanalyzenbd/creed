<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\UserSocialAuthCo;
use App\Http\Controllers\API\UserBusinessOwnerInfoCo;
use App\Http\Controllers\API\UserBusinessPaymentInfoCo;
use App\Http\Controllers\API\AdminBusinessCo;
use App\Http\Controllers\Admin\GoogleBusinessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    // Route::post('/google', [UserSocialAuthCo::class, 'redirectToGoogle'])->name('redirect.google');
    // Route::get('/google/callback', [UserSocialAuthCo::class, 'handleGoogleCallback']);
    Route::post('/google', [UserSocialAuthCo::class, 'handleGoogleCallback']);
    Route::get('apple', [UserSocialAuthCo::class, 'redirectToApple']);
    Route::get('apple/callback', [UserSocialAuthCo::class, 'handleAppleCallback']);
    Route::post('/manual/sign-up', [UserSocialAuthCo::class, 'manualsignUp']);
    Route::post('/manual/sign-in', [UserSocialAuthCo::class, 'manualLogin']);
    Route::post('/send-otp', [UserSocialAuthCo::class, 'sendOtp']);
    Route::post('/verify-otp', [UserSocialAuthCo::class, 'verifyOtp']);
    Route::post('/reset-password', [UserSocialAuthCo::class, 'resetPassword']);
    Route::post('/logout', [UserSocialAuthCo::class, 'logout'])->middleware('auth:sanctum');
});

Route::post('/business-owner-info/store',[UserBusinessOwnerInfoCo::class, 'businessOwnerInfoStore'])->name('businessOwnerInfo.store')->middleware('auth:sanctum');
Route::post('/business-info/store/step1',[UserBusinessOwnerInfoCo::class, 'businessInfoStore1'])->name('businessInfo.store.step1')->middleware('auth:sanctum');
Route::post('/business-info/store/step2',[UserBusinessOwnerInfoCo::class, 'businessInfoStore2'])->name('businessInfo.store.step2')->middleware('auth:sanctum');
Route::post('/business-info/store/step3',[UserBusinessOwnerInfoCo::class, 'businessInfoStore3'])->name('businessInfo.store.step3')->middleware('auth:sanctum');
Route::post('/business-info/store/step4',[UserBusinessOwnerInfoCo::class, 'businessInfoStore4'])->name('businessInfo.store.step4')->middleware('auth:sanctum');
Route::post('/business-info/checkout', [UserBusinessOwnerInfoCo::class, 'checkout'])->name('businessInfo.checkout')->middleware('auth:sanctum');
Route::get('/business/all-dropDown-list', [UserBusinessOwnerInfoCo::class, 'allDropDown'])->name('business.all_dropDown_list');
Route::get('/business/creed-tags', [UserBusinessOwnerInfoCo::class, 'creedTags'])->name('creed.tags');
Route::get('/business-type', [UserBusinessOwnerInfoCo::class, 'businessType'])->name('business.type');
Route::get('/business-category', [UserBusinessOwnerInfoCo::class, 'businessCategory'])->name('business.category');
Route::get('/business-subcategory', [UserBusinessOwnerInfoCo::class, 'businessSubCategory'])->name('business.subcategory');
Route::get('/business-tags', [UserBusinessOwnerInfoCo::class, 'businessTags'])->name('business.tags');
Route::get('/restaurant-data-list', [UserBusinessOwnerInfoCo::class, 'restaurantDataList'])->name('restaurant.list');
Route::get('/country-list', [UserBusinessOwnerInfoCo::class, 'countryList'])->name('country.list');
Route::get('/state-list', [UserBusinessOwnerInfoCo::class, 'stateList'])->name('state.list');
Route::get('/city-list', [UserBusinessOwnerInfoCo::class, 'cityList'])->name('city.list');
Route::get('/days-list', [UserBusinessOwnerInfoCo::class, 'daysList'])->name('days.list');
Route::get('/affiliations-list', [UserBusinessOwnerInfoCo::class, 'affiliationList'])->name('affiliations.list');
Route::get('/subscription-plan-list', [UserBusinessOwnerInfoCo::class, 'subscriptionPlanList'])->name('subscriptionplan.list');
Route::get('/business/nearby', [UserBusinessOwnerInfoCo::class, 'getNearByBusiness'])->name('business.nearby');
Route::get('/business/multi-list', [UserBusinessOwnerInfoCo::class, 'getMultiBusinessList'])->name('business.multiList');
Route::get('/business/single-profile', [UserBusinessOwnerInfoCo::class, 'getBusinessProfile'])->name('business.singleProfile');
Route::get('/user-list', [UserBusinessOwnerInfoCo::class, 'userList'])->name('user.list');

// Route::get('/google-business/profiles', [GoogleBusinessController::class, 'listProfiles']);


// businessList search by Creed Tags
Route::post('/business/search-by-creedtags', [UserBusinessOwnerInfoCo::class, 'searchByCreedTags'])->name('business.search-by-creedtags');
// businessList search by Business-Category-SubCategory-text
Route::get('/business/search-by-catSubCat', [UserBusinessOwnerInfoCo::class, 'searchByBusinessCatSubCategory'])->name('business.search-by-category');
// searchBox
Route::get('/business/search-box', [UserBusinessOwnerInfoCo::class, 'searchBox'])->name('business.search-box');
// businessList search by searchbox text
Route::post('/business/search-searchbox-text', [UserBusinessOwnerInfoCo::class, 'searchBySearchBox'])->name('business.search-searchbox');
// Get Category with relational data
Route::get('/business/category-with-relations', [UserBusinessOwnerInfoCo::class, 'getCategoryRelation'])->name('business.category.relations');
// Get SubCategory with relational data
Route::get('/business/subCategory-with-relations', [UserBusinessOwnerInfoCo::class, 'getSubCategoryRelation'])->name('business.subCategory.relations');

// AboutUs
Route::get('/about-us', [UserBusinessOwnerInfoCo::class, 'aboutUs'])->name('aboutus');
// AppTermsAndConditions
Route::get('/app-termsAndConditions', [UserBusinessOwnerInfoCo::class, 'appTermsAndConditions'])->name('appTermsAndConditions');

Route::post('/save-business-list',[UserBusinessOwnerInfoCo::class, 'saveBusinessList'])->name('save-business-list')->middleware('auth:sanctum');
Route::get('/save-business-list/show',[UserBusinessOwnerInfoCo::class, 'saveBusinessListShow'])->name('save-business-list.show')->middleware('auth:sanctum');

Route::post('/stripe-payment', [UserBusinessPaymentInfoCo::class, 'createPayment'])->name('stripe-payment')->middleware('auth:sanctum');
// Reviews-Rating management
Route::post('/business-rating', [UserBusinessOwnerInfoCo::class, 'businessRating'])->name('business.rating')->middleware('auth:sanctum');
Route::get('/business-rating/delete', [UserBusinessOwnerInfoCo::class, 'ratingDelete'])->name('business.rating.delete')->middleware('auth:sanctum');
Route::get('/business-rating-view', [UserBusinessOwnerInfoCo::class, 'ratingView'])->name('business.rating.view')->middleware('auth:sanctum');

Route::get('/user-details', [UserBusinessOwnerInfoCo::class, 'userDetails'])->name('user.profile.details')->middleware('auth:sanctum');


Route::post('/business-info/image-delete', [UserBusinessOwnerInfoCo::class, 'imageDelete'])->name('business-info.image-delete')->middleware('auth:sanctum');

Route::get('/personal-profile', [UserBusinessOwnerInfoCo::class, 'personalProfile'])->name('user.personal-profile')->middleware('auth:sanctum');
Route::get('/business-profile', [UserBusinessOwnerInfoCo::class, 'businessProfile'])->name('user.business-profile')->middleware('auth:sanctum');

Route::post('/business/filter-screen', [UserBusinessOwnerInfoCo::class, 'filterScreen'])->name('business.filter-screen');

Route::post('/business/call-me', [UserBusinessOwnerInfoCo::class, 'callMe'])->name('business.call-me');
Route::post('/business/quote', [UserBusinessOwnerInfoCo::class, 'quote'])->name('business.quote');

Route::get('/business/direction/{id}', [UserBusinessOwnerInfoCo::class, 'getBusinessDirection'])->name('business.direction');
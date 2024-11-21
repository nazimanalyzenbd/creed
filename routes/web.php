<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pages/dashboard2', function () {
    return view('pages/index2');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::get('/app-profile', function () {
    return view('pages/app-profile');
})->middleware(['auth', 'verified'])->name('app-profile');

Route::get('/app-calender', function () {
    return view('pages/app-calender');
})->middleware(['auth', 'verified'])->name('app-calender');

Route::get('/email-compose', function () {
    return view('pages/email-compose');
})->middleware(['auth', 'verified'])->name('email-compose');

Route::get('/email-inbox', function () {
    return view('pages/email-inbox');
})->middleware(['auth', 'verified'])->name('email-inbox');

Route::get('/email-read', function () {
    return view('pages/email-read');
})->middleware(['auth', 'verified'])->name('email-read');

Route::get('/widget-basic', function () {
    return view('pages/widget-basic');
})->middleware(['auth', 'verified'])->name('widget-basic');

Route::get('/chart-flot', function () {
    return view('pages/chart-flot');
})->middleware(['auth', 'verified'])->name('chart-flot');

Route::get('/chart-morris', function () {
    return view('pages/chart-morris');
})->middleware(['auth', 'verified'])->name('chart-morris');

Route::get('/chart-chartjs', function () {
    return view('pages/chart-chartjs');
})->middleware(['auth', 'verified'])->name('chart-chartjs');

Route::get('/chart-chartist', function () {
    return view('pages/chart-chartist');
})->middleware(['auth', 'verified'])->name('chart-chartist');

Route::get('/chart-sparkline', function () {
    return view('pages/chart-sparkline');
})->middleware(['auth', 'verified'])->name('chart-sparkline');

Route::get('/chart-peity', function () {
    return view('pages/chart-peity');
})->middleware(['auth', 'verified'])->name('chart-peity');

Route::get('/form/form-element', function () {
    return view('pages/form-element');
})->middleware(['auth', 'verified'])->name('form-element');

Route::get('/form/form-wizard', function () {
    return view('pages/form-wizard');
})->middleware(['auth', 'verified'])->name('form-wizard');

Route::get('/form/form-editor-summernote', function () {
    return view('pages/form-editor-summernote');
})->middleware(['auth', 'verified'])->name('form-editor-summernote');

Route::get('/form/form-pickers', function () {
    return view('pages/form-pickers');
})->middleware(['auth', 'verified'])->name('form-pickers');

Route::get('/form/form-validation-jquery', function () {
    return view('pages/form-validation-jquery');
})->middleware(['auth', 'verified'])->name('form-validation-jquery');

Route::get('/table/table-bootstrap-basic', function () {
    return view('pages/table-bootstrap-basic');
})->middleware(['auth', 'verified'])->name('table-bootstrap-basic');

Route::get('/table/table-datatable-basic', function () {
    return view('pages/table-datatable-basic');
})->middleware(['auth', 'verified'])->name('table-datatable-basic');

Route::get('/page-register', function () {
    return view('pages/page-register');
})->middleware(['auth', 'verified'])->name('page-register');

Route::get('/page-login', function () {
    return view('pages/page-login');
})->middleware(['auth', 'verified'])->name('page-login');

Route::get('/page-lock-screen', function () {
    return view('pages/page-lock-screen');
})->middleware(['auth', 'verified'])->name('page-lock-screen');

Route::get('/error/page-error-400', function () {
    return view('pages/page-error-400');
})->middleware(['auth', 'verified'])->name('page-error-400');

Route::get('/error/page-error-403', function () {
    return view('pages/page-error-403');
})->middleware(['auth', 'verified'])->name('page-error-403');

Route::get('/error/page-error-404', function () {
    return view('pages/page-error-404');
})->middleware(['auth', 'verified'])->name('page-error-404');

Route::get('/error/page-error-500', function () {
    return view('pages/page-error-500');
})->middleware(['auth', 'verified'])->name('page-error-500');

Route::get('/error/page-error-503', function () {
    return view('pages/page-error-503');
})->middleware(['auth', 'verified'])->name('page-error-503');

Route::get('/uc-select2', function () {
    return view('pages/uc-select2');
})->middleware(['auth', 'verified'])->name('uc-select2');

Route::get('/uc-nestable', function () {
    return view('pages/uc-nestable');
})->middleware(['auth', 'verified'])->name('uc-nestable');

Route::get('/uc-noui-slider', function () {
    return view('pages/uc-noui-slider');
})->middleware(['auth', 'verified'])->name('uc-noui-slider');

Route::get('/uc-sweetalert', function () {
    return view('pages/uc-sweetalert');
})->middleware(['auth', 'verified'])->name('uc-sweetalert');

Route::get('/uc-toastr', function () {
    return view('pages/uc-toastr');
})->middleware(['auth', 'verified'])->name('uc-toastr');

Route::get('/map-jqvmap', function () {
    return view('pages/map-jqvmap');
})->middleware(['auth', 'verified'])->name('map-jqvmap');

Route::get('/ui-accordion', function () {
    return view('pages/ui-accordion');
})->middleware(['auth', 'verified'])->name('ui-accordion');

Route::get('/ui-alert', function () {
    return view('pages/ui-alert');
})->middleware(['auth', 'verified'])->name('ui-alert');

Route::get('/ui-badge', function () {
    return view('pages/ui-badge');
})->middleware(['auth', 'verified'])->name('ui-badge');

Route::get('/ui-button', function () {
    return view('pages/ui-button');
})->middleware(['auth', 'verified'])->name('ui-button');

Route::get('/ui-button-group', function () {
    return view('pages/ui-button-group');
})->middleware(['auth', 'verified'])->name('ui-button-group');

Route::get('/ui-modal', function () {
    return view('pages/ui-modal');
})->middleware(['auth', 'verified'])->name('ui-modal');

Route::get('/ui-list-group', function () {
    return view('pages/ui-list-group');
})->middleware(['auth', 'verified'])->name('ui-list-group');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

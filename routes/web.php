<?php

use App\Http\Controllers\cms\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.Base');
});

Route::prefix('staff')->controller(StaffController::class)->group(function () {
    Route::get('/', 'getAll')->name('staff.index');
    Route::post('/', 'createStaff');
});

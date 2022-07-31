<?php

use App\Http\Controllers\cms\MahasiswaController;
use App\Http\Controllers\cms\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.Base');
});

Route::prefix('staff')->controller(StaffController::class)->group(function () {
    Route::get('/', 'getAll')->name('staff.index');
    Route::post('/', 'createStaff');
    Route::get('/{id}', 'getStaff');
    Route::patch('/{id}', 'updateStaff');
    Route::delete('/{id}', 'deleteStaff');
});
Route::prefix('mahasiswa')->controller(MahasiswaController::class)->group(function () {
    Route::get('/', 'getAll')->name('mahasiswa.index');
    Route::post('/', 'createMahasiswa');
    Route::get('/{id}', 'getMahasiswa');
    Route::patch('/{id}', 'updateMahasiswa');
    Route::delete('/{id}', 'deleteMahasiswa');
});

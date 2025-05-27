<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::resource('packages', PackageController::class);
Route::resource('residents', ResidentController::class);
Route::get('/', function () {
    return view('index');
});
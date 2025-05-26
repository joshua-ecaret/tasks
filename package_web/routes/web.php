<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::resource('packages',PackageController::class);

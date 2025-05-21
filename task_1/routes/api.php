<?php

use App\Http\Controllers\Api\PackageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('packages', PackageController::class);

Route::get('/now',function(){
    return now()->toDateTimeString();
});


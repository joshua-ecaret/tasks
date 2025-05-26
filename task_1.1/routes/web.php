<?php

use App\Http\Controllers\Api\PackageController;
use App\Models\Package;
use Illuminate\Support\Facades\Route;

Route::get('/packages', function () {
    return view('packages.index' );
});
Route::get('/packages/create', function () {
    return view('packages.create' );
});
Route::get('/packages/update/{package}', function ($packageId) {
    return view('packages.update', ['packageId' => $packageId]);
});
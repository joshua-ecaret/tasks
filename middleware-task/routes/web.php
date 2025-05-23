<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/restricted-area', function (Request $request) {
    $age = $request->query('age', '1');
    
    return ( ['age' => $age]);
})->middleware('valid_age');

Route::get('/up', function () {
    return response()->json(['status' => 'OK']);
});
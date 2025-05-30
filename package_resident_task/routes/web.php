<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::resource('packages', PackageController::class);
Route::resource('residents', ResidentController::class);
Route::get('/', function () {
    return view('index');
});


Route::patch(
    '/residents/{resident}/toggle-status',
    [ResidentController::class, 'toggleStatus']
) ->name('residents.toggleStatus');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['status' => 'success']);
    })->name('notifications.markAsRead');

    Route::delete('/notifications/clear-all', function () {
        auth()->user()->notifications()->delete();
        return response()->json(['status' => 'cleared']);
    })->name('notifications.clearAll');
});

Route::middleware('auth')->get('/notifications/unread', function() {
    return auth()->user()->unreadNotifications()->latest()->get();
});

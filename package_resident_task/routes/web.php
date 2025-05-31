<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
Route::resource('packages', PackageController::class);
Route::resource('residents', ResidentController::class);
Route::get('/', function () {
    return view('index');
});


Route::patch(
    '/residents/{resident}/toggle-status',
    [ResidentController::class, 'toggleStatus']
)->name('residents.toggleStatus');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
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

Route::middleware('auth')->get('/notifications/unread', function () {
    return auth()->user()->unreadNotifications()->latest()->get();
});

Route::get('/check-lang', function () {

    return view('lang-view');
});

Route::post(
    '/locale',
    function (Request $request) {
        $locale = $request->input('locale');
        if (in_array($locale, ['en', 'es'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
)->name('locale.change');

Route::get('send-email',[PackageController::class,'sendEmail']);
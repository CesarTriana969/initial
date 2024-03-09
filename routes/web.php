<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecoderController;


Route::group(['prefix' => 'system'], function () {
    require __DIR__ . '/web/panel.routes.php';
});

Route::fallback(function () {
    return view('principal.alerts.not-found');
});


Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function(){
    Route::get('/', 'index')->name('login');
    Route::post('/user/store', 'store');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});


Route::group(['middleware' => ['auth']], function() {
    Route::get('/decoder', [DecoderController::class, 'index']);
    Route::get('/decoder/{id}', [DecoderController::class, 'decodeDetails']);
});
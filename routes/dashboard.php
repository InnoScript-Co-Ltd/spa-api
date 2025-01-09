<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    UserController,
};


Route::prefix('v1')->group(function () {

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

});

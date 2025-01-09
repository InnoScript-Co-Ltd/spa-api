<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    AuthController,
    UserController,
};


Route::prefix('v1')->group(function () {

    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

    // Protect routes with Sanctum authentication middleware
    Route::middleware('auth:sanctum')->group(function () {
        // Route to get the authenticated user's information

        // UserController routes under 'users' prefix
        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('/', 'index');          // List all users
            Route::post('/', 'store');        // Create a new user
            Route::get('/{id}', 'show');      // Get a specific user
            Route::put('/{id}', 'update');    // Update a user
            Route::delete('/{id}', 'destroy');// Delete a user
        });
    });

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    AuthController,
    UserController,
    LadiesController,
    RoomController,
    SectionController
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

        Route::controller(LadiesController::class)->prefix('ladies')->group(function () {
            Route::get('/', 'index');          // List all ladies
            Route::post('/', 'store');        // Create a new lady
            Route::get('/{id}', 'show');      // Get a specific lady
            Route::put('/{id}', 'update');    // Update a lady
            Route::delete('/{id}', 'destroy');// Delete a lady
        });

        Route::controller(RoomController::class)->prefix('rooms')->group(function () {
            Route::get('/', 'index');          // List all rooms
            Route::post('/', 'store');        // Create a new room
            Route::get('/{id}', 'show');      // Get a specific room
            Route::put('/{id}', 'update');    // Update a room
            Route::delete('/{id}', 'destroy');// Delete a room
        });

        Route::controller(SectionController::class)->prefix("sections")->group(function () {
            Route::get('/', 'index');          // List all sections
            Route::post('/', 'store');        // Create a new section
            Route::get('/{id}', 'show');      // Get a specific section
            Route::put('/{id}', 'update');    // Update a section
            Route::delete('/{id}', 'destroy');// Delete a section
        });

    });

});

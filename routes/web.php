<?php

use App\Http\Controllers\{RegisterController, AuthController, ReminderController, CategoryController};
use Illuminate\Support\Facades\Route;


// Only guests
Route::middleware('guest')->group(function(){

    Route::redirect('/', '/auth');

    // Registering
    Route::controller(RegisterController::class)->group(function(){
        Route::get('/register', 'create')->name('register.create');
        Route::post('/register', 'store')->name('register.store');
    });

    // Authentication
    Route::controller(AuthController::class)->group(function(){
        Route::get('/auth', 'create')->name('auth.create');
        Route::post('/auth', 'store')->name('auth.store');
    });

});

// Only authenticated
Route::middleware('auth')->group(function(){

    Route::redirect('/', '/reminders');

    // Logout
    Route::controller(AuthController::class)->group(function(){
        Route::delete('/auth', 'destroy')->name('auth.destroy');
    });

    // Reminders
    Route::controller(ReminderController::class)->group(function(){
        Route::get('/reminders', 'index')->name('reminders.index');
        Route::get('/reminders/new', 'create')->name('reminders.create');
        Route::get('/reminders/{reminder}', 'show')->name('reminders.show');
        Route::get('/reminders/{reminder}/edit', 'edit')->name('reminders.edit');
        Route::put('/reminders/{reminder}', 'update')->name('reminders.update');
        Route::post('/reminders', 'store')->name('reminders.store');
        Route::delete('/reminders/{reminder}', 'destroy')->name('reminders.destroy');
    });


});



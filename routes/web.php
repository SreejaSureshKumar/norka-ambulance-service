<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();
Route::middleware(['auth', 'NoCache'])->group(function () {
    Route::resource('home', App\Http\Controllers\HomeController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);

});

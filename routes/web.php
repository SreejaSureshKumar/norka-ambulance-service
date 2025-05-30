<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\GenericController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();
Route::middleware(['auth', 'NoCache'])->group(function () {
    Route::resource('home', App\Http\Controllers\HomeController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('usertypes', App\Http\Controllers\UserTypeController::class);
    Route::resource('usercomponent', App\Http\Controllers\ComponentController::class);
    Route::resource('userpermission', App\Http\Controllers\ComponentPermissionController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;

Route::get('/', [App\Http\Controllers\GenericController::class, 'index']);
Route::get('/dashboard', function () {
    return view('welcome');
});

Route::post('/refresh-captcha', [CaptchaController::class, 'image'])->name('refresh-captcha');

Auth::routes();
Route::middleware(['auth', 'NoCache'])->group(function () {
    Route::get('/home/admin', [App\Http\Controllers\HomeController::class, 'admindashboard'])->name('home.admin');
    Route::get('/home/beneficiary', [App\Http\Controllers\HomeController::class, 'userdashboard'])->name('home.beneficiary');
    Route::get('/home/official', [App\Http\Controllers\HomeController::class, 'officialdashboard'])->name('home.official');
   
    
    Route::resource('home', App\Http\Controllers\HomeController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('usertypes', App\Http\Controllers\UserTypeController::class);
    Route::resource('usercomponent', App\Http\Controllers\ComponentController::class);
    Route::resource('userpermission', App\Http\Controllers\ComponentPermissionController::class);
   
});

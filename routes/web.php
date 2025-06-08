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
    Route::get('/beneficiary/application-form', [App\Http\Controllers\BeneficiaryController::class, 'applicationForm'])->name('beneficiary.application-form');
    Route::post('/beneficiary/submit-application', [App\Http\Controllers\BeneficiaryController::class, 'submitApplication'])->name('beneficiary.submit-application');
    Route::get('/beneficiary/application-list', [App\Http\Controllers\BeneficiaryController::class, 'listApplication'])->name('beneficiary.application-list');
    Route::get('/beneficiary/application/{id}', [App\Http\Controllers\BeneficiaryController::class, 'show'])->name('beneficiary.application.show');
    Route::post('/application/process/{id}', [App\Http\Controllers\ApplicationController::class, 'applicationProcess'])->name('application.process');
    Route::get('/application/processed-list', [App\Http\Controllers\ApplicationController::class, 'processedApplications'])->name('application.processed-list');
    
    Route::resource('home', App\Http\Controllers\HomeController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('usertypes', App\Http\Controllers\UserTypeController::class);
    Route::resource('usercomponent', App\Http\Controllers\ComponentController::class);
    Route::resource('userpermission', App\Http\Controllers\ComponentPermissionController::class);
    Route::get('/permissions/components-for-usertype', [\App\Http\Controllers\ComponentPermissionController::class, 'componentsForUsertype'])->name('userpermission.components-for-usertype');
    Route::resource('beneficiary', App\Http\Controllers\BeneficiaryController::class);
    Route::resource('application', App\Http\Controllers\ApplicationController::class);
});

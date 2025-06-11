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
    Route::get('/home/admin', [App\Http\Controllers\HomeController::class, 'admindashboard'])->middleware(['check.usertype'])->name('home.admin');
    Route::get('/home/beneficiary', [App\Http\Controllers\HomeController::class, 'userdashboard'])->middleware(['check.usertype'])->name('home.beneficiary');
    Route::get('/home/official', [App\Http\Controllers\HomeController::class, 'officialdashboard'])->middleware(['check.usertype'])->name('home.official');
    Route::get('/beneficiary/application-form', [App\Http\Controllers\BeneficiaryController::class, 'applicationForm'])->name('beneficiary.application-form');
    Route::post('/beneficiary/submit-application', [App\Http\Controllers\BeneficiaryController::class, 'submitApplication'])->name('beneficiary.submit-application');
    Route::get('/beneficiary/application-list', [App\Http\Controllers\BeneficiaryController::class, 'listApplication'])->middleware(['check.usertype'])->name('beneficiary.application-list');
    Route::get('/beneficiary/application/{id}', [App\Http\Controllers\BeneficiaryController::class, 'show'])->name('beneficiary.application.show');
    Route::post('/application/process/{id}', [App\Http\Controllers\ApplicationController::class, 'applicationProcess'])->name('application.process');
    Route::get('/application/processed-list', [App\Http\Controllers\ApplicationController::class, 'processedApplications'])->middleware(['check.usertype'])->name('application.processed-list');
    Route::get('/application/generate-pdf/{id}', [App\Http\Controllers\ApplicationController::class, 'generateApplicationPdf'])->name('application.generate-application-pdf');


    Route::resource('home', App\Http\Controllers\HomeController::class);
    // Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // Route::resource('usertypes', App\Http\Controllers\UserTypeController::class);
    Route::get('/usertypes', [App\Http\Controllers\UserTypeController::class, 'index'])->name('usertypes.index');
    Route::get('/usertypes/create', [App\Http\Controllers\UserTypeController::class, 'create'])->name('usertypes.create');
    Route::post('/usertypes', [App\Http\Controllers\UserTypeController::class, 'store'])->name('usertypes.store');
    Route::get('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'show'])->name('usertypes.show');
    Route::get('/usertypes/{usertype}/edit', [App\Http\Controllers\UserTypeController::class, 'edit'])->name('usertypes.edit');
    Route::put('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'update'])->name('usertypes.update');
    Route::delete('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'destroy'])->name('usertypes.destroy');

    // Route::resource('usercomponent', App\Http\Controllers\ComponentController::class);
    Route::get('/usercomponent', [App\Http\Controllers\ComponentController::class, 'index'])->name('usercomponent.index');
    Route::get('/usercomponent/create', [App\Http\Controllers\ComponentController::class, 'create'])->name('usercomponent.create');
    Route::post('/usercomponent', [App\Http\Controllers\ComponentController::class, 'store'])->name('usercomponent.store');
    Route::get('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'show'])->name('usercomponent.show');
    Route::get('/usercomponent/{usercomponent}/edit', [App\Http\Controllers\ComponentController::class, 'edit'])->name('usercomponent.edit');
    Route::put('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'update'])->name('usercomponent.update');
    Route::delete('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'destroy'])->name('usercomponent.destroy');

    // Route::resource('userpermission', App\Http\Controllers\ComponentPermissionController::class);
    Route::get('/userpermission', [App\Http\Controllers\ComponentPermissionController::class, 'index'])->name('userpermission.index');
    Route::get('/userpermission/create', [App\Http\Controllers\ComponentPermissionController::class, 'create'])->name('userpermission.create');
    Route::post('/userpermission', [App\Http\Controllers\ComponentPermissionController::class, 'store'])->name('userpermission.store');
    Route::get('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'show'])->name('userpermission.show');
    Route::get('/userpermission/{permission}/edit', [App\Http\Controllers\ComponentPermissionController::class, 'edit'])->name('userpermission.edit');
    Route::put('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'update'])->name('userpermission.update');
    Route::delete('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'destroy'])->name('userpermission.destroy');
    Route::get('/permissions/components-for-usertype', [\App\Http\Controllers\ComponentPermissionController::class, 'componentsForUsertype'])->name('userpermission.components-for-usertype');

    Route::get('beneficiary', [App\Http\Controllers\BeneficiaryController::class, 'index'])->name('beneficiary.index');
    Route::get('beneficiary/{app_id}', [App\Http\Controllers\BeneficiaryController::class, 'show'])->name('beneficiary.show');
    Route::get('application', [App\Http\Controllers\ApplicationController::class, 'index'])->name('application.index');
    Route::get('application/{app_id}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('application.show');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;

Route::get('/', [App\Http\Controllers\GenericController::class, 'index']);
Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/refresh-captcha', [CaptchaController::class, 'image'])->name('refresh-captcha');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::post('/validate-user', [App\Http\Controllers\CaptchaController::class, 'validateUser'])->name('user-validation');
Route::get('/load-districts', [App\Http\Controllers\BeneficiaryController::class, 'loadDistricts'])->name('load-districts');

Auth::routes();
Route::middleware(['auth', 'NoCache'])->group(function () {
    Route::get('/home/admin', [App\Http\Controllers\HomeController::class, 'admindashboard'])->middleware(['check.usertype'])->name('home.admin');
    Route::get('/home/beneficiary', [App\Http\Controllers\HomeController::class, 'userdashboard'])->middleware(['check.usertype'])->name('home.beneficiary');
    Route::get('/home/official', [App\Http\Controllers\HomeController::class, 'officialdashboard'])->middleware(['check.usertype'])->name('home.official');

    Route::get('/beneficiary/application-list', [App\Http\Controllers\BeneficiaryController::class, 'listApplication'])->middleware(['check.usertype'])->name('beneficiary.application-list');
    Route::get('/application/processed-list', [App\Http\Controllers\ApplicationController::class, 'processedApplications'])->middleware(['check.usertype'])->name('application.processed-list');
    Route::get('/application/rejected-list', [App\Http\Controllers\ApplicationController::class, 'rejectedApplications'])->middleware(['check.usertype'])->name('application.rejected-list');
    Route::get('/service-application/application-list', [App\Http\Controllers\AmbulanceApplicationController::class, 'index'])->middleware(['check.usertype'])->name('service.application-list');
    Route::get('/service-application/processed-list', [App\Http\Controllers\AmbulanceApplicationController::class, 'processedApplications'])->middleware(['check.usertype'])->name('service.processed-list');
    Route::get('/service-application/rejected-list', [App\Http\Controllers\AmbulanceApplicationController::class, 'rejectedApplications'])->middleware(['check.usertype'])->name('service.rejected-list');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware(['check.usertype']);
    Route::get('/usertypes', [App\Http\Controllers\UserTypeController::class, 'index'])->name('usertypes.index')->middleware(['check.usertype']);
    Route::get('/usercomponent', [App\Http\Controllers\ComponentController::class, 'index'])->name('usercomponent.index')->middleware(['check.usertype']);
    Route::get('/userpermission', [App\Http\Controllers\ComponentPermissionController::class, 'index'])->name('userpermission.index')->middleware(['check.usertype']);
    Route::get('beneficiary', [App\Http\Controllers\BeneficiaryController::class, 'index'])->name('beneficiary.index')->middleware(['check.usertype']);
    Route::get('application', [App\Http\Controllers\ApplicationController::class, 'index'])->name('application.index')->middleware(['check.usertype']);
    Route::get('new-application', [App\Http\Controllers\AgencyController::class, 'index'])->name('agency.index')->middleware(['check.usertype']);
    Route::get('service-completed-list', [App\Http\Controllers\AgencyController::class, 'serviceCompletedList'])->name('agency.service-completed-list')->middleware(['check.usertype']);
    Route::get('ambulance-service-completed-list', [App\Http\Controllers\AmbulanceApplicationController::class, 'serviceCompletedList'])->name('service-application.service-completed')->middleware(['check.usertype']);

    
    Route::middleware(['auth.usertype:beneficiary'])->group(function () {
        Route::get('/beneficiary/application-form', [App\Http\Controllers\BeneficiaryController::class, 'applicationForm'])->name('beneficiary.application-form');
        Route::post('/beneficiary/submit-application', [App\Http\Controllers\BeneficiaryController::class, 'submitApplication'])->name('beneficiary.submit-application');
        Route::get('/beneficiary/application/{app_id}', [App\Http\Controllers\BeneficiaryController::class, 'show'])->name('beneficiary.application-show');
        Route::post('/beneficiary/validate-application', [App\Http\Controllers\BeneficiaryController::class, 'validateApplication'])->name('beneficiary.application-validate');
        Route::get('/beneficiary/ambulance-application-form', [App\Http\Controllers\BeneficiaryController::class, 'serviceApplicationForm'])->name('beneficiary.service-application-form');
        Route::post('/beneficiary/application-submit', [App\Http\Controllers\BeneficiaryController::class, 'applicationSubmission'])->name('beneficiary.application-submit');
        Route::post('/beneficiary/application-validation', [App\Http\Controllers\BeneficiaryController::class, 'applicationValidation'])->name('beneficiary.validate-application');
        Route::get('/beneficiary/application-details/{app_id}', [App\Http\Controllers\BeneficiaryController::class, 'applicationDetails'])->name('beneficiary.application-details');
        Route::post('/beneficiary/date-field-validation', [App\Http\Controllers\BeneficiaryController::class, 'datefieldValidation'])->name('beneficiary.date-field-validation');
    });


    Route::middleware(['auth.usertype:official_user,nodal_officer'])->group(function () {

        Route::post('/application/application-action/{id}', [App\Http\Controllers\ApplicationController::class, 'applicationProcess'])->name('application.application-action');


        Route::post('/application/process/{id}', [App\Http\Controllers\AmbulanceApplicationController::class, 'applicationProcess'])->name('application.application-process');
        Route::post('/application/process-application/{id}', [App\Http\Controllers\AmbulanceApplicationController::class, 'applicationProcess'])->name('application.process-application');
        Route::post('/assign-to-agency', [App\Http\Controllers\AmbulanceApplicationController::class, 'agencyAssign'])->name('application.assign-agency');
    });

    Route::middleware(['auth.usertype:official_user,beneficiary,nodal_officer'])->group(function () {
        Route::get('/application/generate-pdf/{app_id}', [App\Http\Controllers\ApplicationController::class, 'generateApplicationPdf'])->name('application.generate-application-pdf');
    });
    Route::middleware(['auth.usertype:official_user,nodal_officer'])->group(function () {
        Route::get('/application/{app_id}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('application.show');
    });


    Route::middleware(['auth.usertype:official_user,agency_user,nodal_officer'])->group(function () {
        Route::get('/application/application-details/{app_id}', [App\Http\Controllers\AmbulanceApplicationController::class, 'applicationDetails'])->name('application.application-details');
    });

    Route::middleware(['auth.usertype:agency_user'])->group(function () {
        Route::post('add-details', [App\Http\Controllers\AgencyController::class, 'addDetails'])->name('agency.add-details');
        Route::post('mark-completed', [App\Http\Controllers\AgencyController::class, 'markCompleted'])->name('agency.mark-completed');
        Route::post('add-service-details', [App\Http\Controllers\AgencyController::class, 'addServiceDetails'])->name('agency.add-service-details');
       
    });
    Route::middleware(['auth.usertype:admin_user'])->group(function () {

        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/usertypes/create', [App\Http\Controllers\UserTypeController::class, 'create'])->name('usertypes.create');
        Route::post('/usertypes', [App\Http\Controllers\UserTypeController::class, 'store'])->name('usertypes.store');
        Route::get('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'show'])->name('usertypes.show');
        Route::get('/usertypes/{usertype}/edit', [App\Http\Controllers\UserTypeController::class, 'edit'])->name('usertypes.edit');
        Route::put('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'update'])->name('usertypes.update');
        Route::delete('/usertypes/{usertype}', [App\Http\Controllers\UserTypeController::class, 'destroy'])->name('usertypes.destroy');

        Route::get('/usercomponent/create', [App\Http\Controllers\ComponentController::class, 'create'])->name('usercomponent.create');
        Route::post('/usercomponent', [App\Http\Controllers\ComponentController::class, 'store'])->name('usercomponent.store');
        Route::get('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'show'])->name('usercomponent.show');
        Route::get('/usercomponent/{usercomponent}/edit', [App\Http\Controllers\ComponentController::class, 'edit'])->name('usercomponent.edit');
        Route::put('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'update'])->name('usercomponent.update');
        Route::delete('/usercomponent/{usercomponent}', [App\Http\Controllers\ComponentController::class, 'destroy'])->name('usercomponent.destroy');

        Route::get('/userpermission/create', [App\Http\Controllers\ComponentPermissionController::class, 'create'])->name('userpermission.create');
        Route::post('/userpermission', [App\Http\Controllers\ComponentPermissionController::class, 'store'])->name('userpermission.store');
        Route::get('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'show'])->name('userpermission.show');
        Route::get('/userpermission/{permission}/edit', [App\Http\Controllers\ComponentPermissionController::class, 'edit'])->name('userpermission.edit');
        Route::put('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'update'])->name('userpermission.update');
        Route::delete('/userpermission/{permission}', [App\Http\Controllers\ComponentPermissionController::class, 'destroy'])->name('userpermission.destroy');
        Route::get('/permissions/components-for-usertype', [\App\Http\Controllers\ComponentPermissionController::class, 'componentsForUsertype'])->name('userpermission.components-for-usertype');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PersonalDataController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes untuk user
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/jobs/{jobId}/apply', [ApplicationController::class, 'create'])->name('application.apply');
    Route::post('/jobs/{jobId}/apply', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::get('applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');

    Route::get('/job-vacancies/{id}', [JobVacancyController::class, 'show'])->name('job-vacancies.show');
    Route::put('applications/{application}/updateStatus', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    Route::get('/dashboard', [JobVacancyController::class, 'dashboard'])->name('dashboard');
    Route::get('/recomendation', [JobVacancyController::class, 'recomendation'])->name('recomendation');
    Route::resource('personal_data', PersonalDataController::class);

    Route::middleware(['role:employee'])->group(function () {
        Route::resource('job_vacancies', JobVacancyController::class);
        Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.settings');
        Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
        Route::get('/job-vacancies/{jobVacancy}/applicants', [JobVacancyController::class, 'showApplicants'])->name('job_vacancies.show_applicants');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('/admin/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
        Route::get('/admin/companies', [CompanyController::class, 'adminIndex'])->name('admin.companies.index');
        Route::post('/admin/companies/{company}/status', [CompanyController::class, 'updateStatus'])->name('admin.companies.updateStatus');
    });
});

require __DIR__ . '/auth.php';

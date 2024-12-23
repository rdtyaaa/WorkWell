<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobVacancyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes untuk user
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');

    // Route::middleware(['isEmployer'])->group(function () {
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.settings');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::resource('job_vacancies', JobVacancyController::class);
// });

    // Routes untuk admin
    // Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/companies', [CompanyController::class, 'adminIndex'])->name('admin.companies.index');
        Route::post('/admin/companies/{company}/status', [CompanyController::class, 'updateStatus'])->name('admin.companies.updateStatus');
    // });
});

require __DIR__.'/auth.php';

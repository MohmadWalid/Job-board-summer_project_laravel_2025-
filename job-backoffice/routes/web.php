<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Main route group requiring authentication
// ==== SHARED ROUTES (role:admin,company-owner) ====
Route::middleware(['auth', 'role:admin,company-owner'])->group(function () {

    // Redirect root URL to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Job Applications
    Route::resource('/job-applications', JobApplicationController::class)->except('create', 'store');
    Route::put('job-applications/{id}/restore', [JobApplicationController::class, 'restore'])->name('job-applications.restore');

    // Job Vacancies
    Route::resource('/job-vacancies', JobVacancyController::class);
    Route::put('job-vacancies/{id}/restore', [JobVacancyController::class, 'restore'])->name('job-vacancies.restore');
});

// ==== COMPANY OWNER ROUTES ====
Route::middleware(['auth', 'role:company-owner'])->group(function () {
    // Show My company
    Route::get('/my-company', [CompanyController::class, 'show'])->name('my-company.show');

    // Edit My company
    Route::get('/my-company/edit', [CompanyController::class, 'edit'])->name('my-company.edit');

    // Update My company
    Route::put('/my-company', [CompanyController::class, 'update'])->name('my-company.update');
});

// ==== ADMIN ROUTES ====
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::put('companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');

    // Job Categories
    Route::resource('/job-categories', JobCategoryController::class)->except('show');
    Route::put('Job-categories/{id}/restore', [JobCategoryController::class, 'restore'])->name('job-categories.restore');

    // Users
    Route::resource('/users', UserController::class)->except('create', 'store');
    Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
});

require __DIR__ . '/auth.php';

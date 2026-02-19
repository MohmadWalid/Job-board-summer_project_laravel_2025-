<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeepSeekController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Gemini\Laravel\Facades\Gemini;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');

    Route::get('/job-vacancies/{jobVacancy}', [JobVacancyController::class, 'show'])->name('job-vacancies.show');
    Route::get('/job-vacancies/{jobVacancy}/apply', [JobVacancyController::class, 'apply'])->name('job-vacancies.apply');
    Route::post('/job-vacancies/{jobVacancy}/apply', [JobVacancyController::class, 'storeApplication'])->name('job-vacancies.storeApplication');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tested Routes
    Route::get('/test-gemini', function () {
        $response = Gemini::generativeModel(model: 'gemini-2.0-flash')  // or just Gemini::geminiFlash()
            ->generateContent('Write a very short funny job interview question for a Laravel developer');

        return $response->text();
    });
});

require __DIR__ . '/auth.php';

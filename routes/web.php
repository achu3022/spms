<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPerformanceController;
use App\Http\Controllers\TvDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// TV Dashboard Routes (Publicly accessible for easy TV display)
Route::get('/tv', [TvDashboardController::class, 'index'])->name('tv.dashboard');
Route::get('/tv/data', [TvDashboardController::class, 'data'])->name('tv.data');

Route::middleware(['auth'])->group(function () {
    // Password Setup Routes
    Route::get('/setup-password', [\App\Http\Controllers\Auth\PasswordSetupController::class, 'create'])->name('password.setup');
    Route::post('/setup-password', [\App\Http\Controllers\Auth\PasswordSetupController::class, 'store'])->name('password.setup.store');
    // League Welcome Page
    Route::get('/welcome-league', [\App\Http\Controllers\LeagueWelcomeController::class, 'index'])->name('welcome.league');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/team/performance-data', [DashboardController::class, 'teamPerformanceData'])->name('team.performance.data');

    // Enquiries Module
    Route::resource('enquiries', EnquiryController::class);
    Route::get('/enquiries/districts/{state}', [EnquiryController::class, 'getDistricts'])->name('enquiries.districts');

    // Daily Closings
    Route::post('/daily-closings', [\App\Http\Controllers\DailyClosingController::class, 'store'])->name('daily-closings.store');

    // Activities additions (Follow-up & Payment)
    Route::post('/enquiries/{enquiry}/follow-ups', [FollowUpController::class, 'store'])->name('enquiries.followups.store');
    Route::post('/enquiries/{enquiry}/payments', [PaymentController::class, 'store'])->name('enquiries.payments.store');

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // Reports Module
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

    // Global Search
    Route::get('/search', [SearchController::class, 'query'])->name('search');

    // Spatie Permission Role Guards (Admin / Sales Head)
    Route::middleware(['role:Super Admin|Sales Head (HOD)'])->group(function () {
        // Past Activities (Manual Entry)
        Route::get('/past-activities/existing', [\App\Http\Controllers\PastActivityController::class, 'getExisting'])->name('past-activities.existing');
        Route::get('/past-activities/create', [\App\Http\Controllers\PastActivityController::class, 'create'])->name('past-activities.create');
        Route::post('/past-activities', [\App\Http\Controllers\PastActivityController::class, 'store'])->name('past-activities.store');

        // Teams Module
        Route::resource('teams', TeamController::class);

        // Users / Employees Module
        Route::resource('users', UserController::class);

        // Activity Management / Score Editing
        Route::get('/activities-manage', [\App\Http\Controllers\ActivityManagementController::class, 'index'])->name('activities-manage.index');
        Route::post('/activities-manage/adjust', [\App\Http\Controllers\ActivityManagementController::class, 'adjust'])->name('activities-manage.adjust');
        Route::patch('/activities-manage/{id}', [\App\Http\Controllers\ActivityManagementController::class, 'update'])->name('activities-manage.update');
        Route::delete('/activities-manage/{id}', [\App\Http\Controllers\ActivityManagementController::class, 'destroy'])->name('activities-manage.destroy');

        // Target Settings
        Route::get('/target-settings', [App\Http\Controllers\TargetSettingController::class, 'index'])->name('target-settings.index');
        Route::post('/target-settings', [App\Http\Controllers\TargetSettingController::class, 'update'])->name('target-settings.update');

        // Application Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });

    // Profile Management (Default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Super Admin Only Features
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/admin/performance', [AdminPerformanceController::class, 'index'])->name('admin.performance.index');
        Route::get('/admin/performance/export', [AdminPerformanceController::class, 'export'])->name('admin.performance.export');
    });
});

require __DIR__.'/auth.php';

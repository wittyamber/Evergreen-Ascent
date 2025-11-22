<?php

use Illuminate\Support\Facades\Route;

// Controllers - General
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\ApplicationController;

// Controllers - Applicant
use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboardController;
use App\Http\Controllers\Applicant\ApplicationController as ApplicantAppController;
use App\Http\Controllers\Applicant\InterviewController as ApplicantInterviewController;

// Controllers - HR
use App\Http\Controllers\Hr\DashboardController as HrDashboardController;
use App\Http\Controllers\Hr\JobPostingController as HrJobController;
use App\Http\Controllers\Hr\ApplicationController as HrAppController;
use App\Http\Controllers\Hr\ApplicationNoteController;
use App\Http\Controllers\Hr\InterviewController as HrInterviewController;
use App\Http\Controllers\Hr\ApplicationMessageController;

// Controllers - Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\SystemSettingsController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (No Login Required)
|--------------------------------------------------------------------------
*/
Route::get('/', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobPostingController::class, 'show'])->name('jobs.show');

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATED COMMON ROUTES (Profile, etc.)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- THE TRAFFIC CONTROLLER ---
    // This is the ONE AND ONLY /dashboard route. 
    // It decides where you go based on your role.
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role === 'hr') {
            return redirect()->route('hr.dashboard');
        }

        // If Applicant, show the applicant dashboard directly
        return app(ApplicantDashboardController::class)->index();
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. APPLICANT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Applying for a job
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    
    // Managing Applications & Interviews
    Route::get('/my-applications', [ApplicantAppController::class, 'index'])->name('applicant.applications.index');
    
    // Interview Actions
    Route::put('/interviews/{interview}/confirm', [ApplicantInterviewController::class, 'update'])->name('applicant.interviews.update');
    Route::get('/interviews/{interview}/reschedule', [ApplicantInterviewController::class, 'showRescheduleForm'])->name('applicant.interviews.reschedule.show');
    Route::put('/interviews/{interview}/reschedule', [ApplicantInterviewController::class, 'processRescheduleRequest'])->name('applicant.interviews.reschedule.store');
});

/*
|--------------------------------------------------------------------------
| 4. HR ROUTES (Prefix: /hr)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:hr,admin'])->prefix('hr')->name('hr.')->group(function () {
    
    Route::get('/dashboard', [HrDashboardController::class, 'index'])->name('dashboard');

    // Job Management
    Route::resource('jobs', HrJobController::class); // Names are auto-generated as hr.jobs.index, etc.

    // Application Management
    Route::get('/jobs/{job}/applications', [HrAppController::class, 'index'])->name('jobs.applications.index');
    Route::get('/applications/{application}', [HrAppController::class, 'show'])->name('applications.show');
    Route::put('/applications/{application}', [HrAppController::class, 'update'])->name('applications.update');
    
    // Notes & Messages
    Route::post('/applications/{application}/notes', [ApplicationNoteController::class, 'store'])->name('applications.notes.store');
    Route::post('/applications/{application}/messages', [ApplicationMessageController::class, 'store'])->name('applications.messages.store');

    // Interview Management
    Route::get('/interviews', [HrInterviewController::class, 'index'])->name('interviews.index');
    Route::get('/applications/{application}/interviews/create', [HrInterviewController::class, 'create'])->name('interviews.create');
    Route::post('/applications/{application}/interviews/store', [HrInterviewController::class, 'store'])->name('interviews.store');
    Route::delete('/interviews/{interview}', [HrInterviewController::class, 'destroy'])->name('interviews.destroy');
});

/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES (Prefix: /admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // HR User Management
    Route::resource('users', UserManagementController::class);

    // System Settings
    Route::get('/settings', [SystemSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SystemSettingsController::class, 'update'])->name('settings.update');

    // Audit Logs
    Route::get('/audit-logs', [AdminDashboardController::class, 'logs'])->name('audit.logs');
});
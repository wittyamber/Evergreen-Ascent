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
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (No Login Required)
|--------------------------------------------------------------------------
*/

// 1. New Corporate Landing Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/system', [PublicController::class, 'system'])->name('system');

// 2. The Job Board (Moved to /careers)
Route::get('/careers', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/careers/{job}', [JobPostingController::class, 'show'])->name('jobs.show');

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
    // 1. Applying for a job
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    
    // 2. Listing Applications
    Route::get('/my-applications', [ApplicantAppController::class, 'index'])->name('applicant.applications.index');
    
    // 3. Single Application Details (Chat & Status)
    Route::get('/my-applications/{application}', [ApplicantAppController::class, 'show'])->name('applicant.applications.show');
    
    // 4. Interview Actions
    // CONFIRM Route (Points to 'confirm' method)
    Route::put('/interviews/{interview}/confirm', [ApplicantInterviewController::class, 'confirm'])->name('applicant.interviews.confirm');
    
    // RESCHEDULE Routes
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
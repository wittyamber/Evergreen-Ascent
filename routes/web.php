<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Applicant\DashboardController;

// The homepage is now the public job listing page.
Route::get('/', [App\Http\Controllers\JobPostingController::class, 'index'])->name('jobs.index');
// This is the route for viewing a single public job.
Route::get('/jobs/{job}', [App\Http\Controllers\JobPostingController::class, 'show'])->name('jobs.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin' || $user->role === 'hr') {
        return redirect()->route('hr.dashboard');
    }

    // Default for applicants
    return view('dashboard');


})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add this line for submitting an application
    Route::post('/jobs/{job}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');

    // ADD THIS ROUTE FOR THE APPLICANT'S APPLICATION LIST
    Route::get('/my-applications', [App\Http\Controllers\Applicant\ApplicationController::class, 'index'])->name('applicant.applications.index');

    Route::put('/interviews/{interview}/confirm', [App\Http\Controllers\Applicant\InterviewController::class, 'update'])->name('applicant.interviews.update');

    // ADD this GET route for the reschedule form
    Route::get('/interviews/{interview}/reschedule', [App\Http\Controllers\Applicant\InterviewController::class, 'showRescheduleForm'])->name('applicant.interviews.reschedule.show');

    // ADD this PUT route to process the reschedule request
    Route::put('/interviews/{interview}/reschedule', [App\Http\Controllers\Applicant\InterviewController::class, 'processRescheduleRequest'])->name('applicant.interviews.reschedule.store');
});

require __DIR__.'/auth.php';

// =============================================================
// HR & ADMIN ROUTES
// =============================================================
Route::middleware(['auth', 'role:hr,admin'])->prefix('hr')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Hr\DashboardController::class, 'index'])->name('hr.dashboard');

    // Add this new route for viewing applications for a job
    Route::get('/jobs/{job}/applications', [App\Http\Controllers\Hr\ApplicationController::class, 'index'])->name('hr.jobs.applications.index');

    // ADD A ROUTE FOR SHOWING A SINGLE APPLICATION
    Route::get('/applications/{application}', [App\Http\Controllers\Hr\ApplicationController::class, 'show'])->name('hr.applications.show');

    // ADD THIS ROUTE FOR UPDATING THE STATUS
    Route::put('/applications/{application}', [App\Http\Controllers\Hr\ApplicationController::class, 'update'])->name('hr.applications.update');

    // ADD THIS ROUTE FOR STORING A NOTE
    Route::post('/applications/{application}/notes', [App\Http\Controllers\Hr\ApplicationNoteController::class, 'store'])->name('hr.applications.notes.store');

    // Manually name the resource routes to ensure the 'hr.' prefix
    Route::resource('jobs', App\Http\Controllers\Hr\JobPostingController::class)->names([
        'index' => 'hr.jobs.index',
        'create' => 'hr.jobs.create',
        'store' => 'hr.jobs.store',
        'show' => 'hr.jobs.show',
        'edit' => 'hr.jobs.edit',
        'update' => 'hr.jobs.update',
        'destroy' => 'hr.jobs.destroy',
    ]);

    // ADD THIS ROUTE for the interview creation form
    Route::get('/applications/{application}/interviews/create', [App\Http\Controllers\Hr\InterviewController::class, 'create'])->name('hr.interviews.create');

    // INTERVIEW STORE ROUTE
     Route::post('/applications/{application}/interviews/store', [App\Http\Controllers\Hr\InterviewController::class, 'store'])->name('hr.interviews.store');

      // NEW ROUTE FOR THE CONSOLIDATED AGENDA
    Route::get('/interviews', [App\Http\Controllers\Hr\InterviewController::class, 'index'])->name('hr.interviews.index');

    // THIS ROUTE for cancelling an interview
    Route::delete('/interviews/{interview}', [App\Http\Controllers\Hr\InterviewController::class, 'destroy'])->name('hr.interviews.destroy');

    Route::post('/applications/{application}/messages', [App\Http\Controllers\Hr\ApplicationMessageController::class, 'store'])->name('hr.applications.messages.store');
});
<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusUpdated;

class ApplicationController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(JobPosting $job)
    {
        // Authorize that the current user can view applications for this job.
        // We'll reuse the 'update' policy logic from JobPostingPolicy.
        // If they can update the job, they can see its applicants.
        $this->authorize('update', $job);

        // Load the applications with the applicant's user data to avoid extra database queries in the view.
        $applications = $job->applications()->with('user')->latest()->get();

        return view('hr.applications.index', [
            'job' => $job,
            'applications' => $applications,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified application.
     */
    public function show(Application $application)
    {
        // Use the job posting policy to ensure the HR user owns the job this application is for.
        $this->authorize('update', $application->jobPosting);

        // Eager load the user (applicant) and the notes with their authors
        $application->load('user', 'notes.author');

        return view('hr.applications.show', [
            'application' => $application,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified application in storage.
     */
    public function update(Request $request, Application $application)
    {
        // Authorize that the user can update the job posting this application belongs to
        $this->authorize('update', $application->jobPosting);

        // Validate the incoming request
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:Submitted,Under Review,Interview Scheduled,Offer Extended,Hired,Rejected'],
        ]);

        // Update the application status
        $application->update($validated);

        // --- SEND THE EMAIL NOTIFICATION ---
        Mail::to($application->user->email)->send(new ApplicationStatusUpdated($application));

        // Redirect back to the same page with a success message
        return redirect()->route('hr.applications.show', $application)->with('status', 'Application status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

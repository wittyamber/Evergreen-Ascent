<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPosting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobPostingController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get logged-in HR user
        $user = \Illuminate\Support\Facades\Auth::user();

        // Fetch jobs with the count of applications (Optimization)
        $jobs = $user->jobPostings()
                    ->withCount('applications') // <--- This adds an 'applications_count' attribute
                    ->latest()
                    ->paginate(10);

        return view('hr.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
         // 1. Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Contract,Internship',
            'description' => 'required|string',
        ]);

        // 2. Create the job posting, associating it with the current user
        $request->user()->jobPostings()->create([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'salary_range' => $validated['salary_range'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            // 'status' will default to 'Draft' as we defined in the migration
        ]);

        // 3. Redirect back to the dashboard with a success message
        return redirect()->route('hr.dashboard')->with('status', 'Job posting created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosting $job)
    {
        // The $job variable is automatically fetched by Laravel based on the ID in the URL
        return view('hr.jobs.edit', [
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $job): RedirectResponse
    {
        // 1. Authorize that the current user can update this job
        $this->authorize('update', $job);

        // 2. Validate the incoming request data (same rules as store)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Contract,Internship',
            'description' => 'required|string',
            'status' => 'required|in:Draft,Active,Archived',
        ]);

        // 3. Update the job posting with the validated data
        $job->update($validated);

        // 4. Redirect back to the dashboard with a success message
        return redirect()->route('hr.dashboard')->with('status', 'Job posting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $job)
    {
        // 1. Authorize: Ensure the user owns this job posting.
        $this->authorize('update', $job); // We can reuse the 'update' policy logic.

        // 2. Delete the job posting.
        // Because of the 'onDelete('cascade')' in our migrations,
        // all associated 'applications', 'interviews', and 'notes' will be deleted automatically.
        $job->delete();

        // 3. Redirect back with a success message.
        return redirect()->route('hr.dashboard')->with('status', 'Job posting and all associated applications have been permanently deleted.');
    }
}

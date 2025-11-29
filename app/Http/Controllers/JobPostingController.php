<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    /**
     * Display a public listing of the resource.
     */
    public function index(): View
    {
        // 1. Fetch the jobs (Only active ones, usually)
        $jobs = JobPosting::where('status', 'active') // Assuming you have a status column
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); 
                    // If you don't have a 'status' column yet, just use: JobPosting::latest()->paginate(10);

        // 2. Return the view AND pass the $jobs variable
        return view('jobs.index', compact('jobs')); 
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $job): View
    {
        // We can add a check here to ensure the job is 'Active'
        // This prevents people from guessing URLs for draft jobs.
        if ($job->status !== 'Active') {
            abort(404);
        }

        // Pass the single job to the show view
        return view('jobs.show', compact('job'));
    }
}

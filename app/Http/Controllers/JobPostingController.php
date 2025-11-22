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
        $jobPostings = JobPosting::where('status', 'Active')
                                 ->latest()
                                 ->get();

        return view('jobs.index', [
            'jobPostings' => $jobPostings,
        ]);
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

        return view('jobs.show', [
            'job' => $job,
        ]);
    }
}

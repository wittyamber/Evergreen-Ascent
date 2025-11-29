<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Support\Facades\Auth; // <-- THIS IS THE MISSING ONE
use Illuminate\View\View;            // <-- We added this for type-hinting
use App\Models\JobPosting;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
       // 1. Get the currently authenticated HR user
        $user = Auth::user();

        // 2. Fetch jobs belonging ONLY to this HR user
        $jobPostings = $user->jobPostings()
                    ->orderBy('created_at', 'desc')
                    ->get();

        // 3. Calculate Stats for the Dashboard Cards
        // We only count stats for *your* jobs, not the whole company's (for privacy/relevance)
        
        $activeJobs = $jobPostings->where('status', 'Active')->count();

        // Get IDs of all your jobs to find related applications
        $myJobIds = $jobPostings->pluck('id');

        // Count applicants specifically for your jobs
        $totalApplicants = Application::whereIn('job_posting_id', $myJobIds)->count();
        $pendingReviews = Application::whereIn('job_posting_id', $myJobIds)
                                     ->where('status', 'pending')
                                     ->count();

        // 4. Return everything to the view
        return view('hr.dashboard', compact('jobPostings', 'activeJobs', 'totalApplicants', 'pendingReviews'));
    }
}
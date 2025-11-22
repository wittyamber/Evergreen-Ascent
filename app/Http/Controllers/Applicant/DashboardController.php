<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dispatcher Logic (stays the same)
        if (in_array($user->role, ['admin', 'hr'])) {
            return redirect()->route('hr.dashboard');
        }

        // --- Data Fetching for Applicant ---

        // Get upcoming interviews (same as before)
        $upcomingInterviews = $user->interviews()
                                   ->where('interviews.status', 'Scheduled')
                                   ->where('scheduled_at', '>=', now())
                                   ->orderBy('scheduled_at', 'asc')
                                   ->get();
        
        // NEW: Get all applications to display their progress
        $applications = $user->applications()
                                ->with('jobPosting')
                                ->latest()
                                ->get();

        // Return the applicant's dashboard view with all the data
        return view('dashboard', [
            'upcomingInterviews' => $upcomingInterviews,
            'applications' => $applications, // CHANGED from 'activeApplications'
        ]);
    }
}
<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Support\Facades\Auth; // <-- THIS IS THE MISSING ONE
use Illuminate\View\View;            // <-- We added this for type-hinting

class DashboardController extends Controller
{
    public function index()
    {
       // Get the currently authenticated user
        $user = Auth::user();

        // Fetch only the job postings that belong to this user
        $jobPostings = $user->jobPostings()
                    ->whereIn('status', ['Active', 'Draft'])
                    ->latest()
                    ->get();

        // Pass the job postings to the view
        return view('hr.dashboard', [
            'jobPostings' => $jobPostings,
        ]);
    }
}
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

        // 1. Safety Redirect (Just in case an HR user stumbles here)
        if (in_array($user->role, ['admin', 'hr'])) {
            return redirect()->route('hr.dashboard');
        }

        // 2. Calculate Stats for the Dashboard Cards
        $applicationsCount = $user->applications()->count();

        $interviewsCount = $user->interviews()
                                ->where('interviews.status', 'Scheduled') // Explicit table name is safer
                                ->where('scheduled_at', '>=', now())
                                ->count();

        // 3. Return the specific Applicant View
        // IMPORTANT: This points to resources/views/applicant/dashboard.blade.php
        return view('applicant.dashboard', compact('applicationsCount', 'interviewsCount'));
    }
}
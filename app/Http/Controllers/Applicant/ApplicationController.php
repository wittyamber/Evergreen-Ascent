<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Application; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * List all applications for the current user.
     */
    public function index()
    {
        $user = Auth::user();

        // Eager load relationships. 
        // Changed 'messages.sender' to 'messages.author' to match the View code.
        $applications = $user->applications()
                             ->with(['jobPosting', 'interviews', 'messages.author'])
                             ->latest()
                             ->get();

        return view('applicant.applications.index', [
            'applications' => $applications,
        ]);
    }

    /**
     * Show a single application details + messages.
     * This is the function powering the new "Message Page".
     */
    public function show(Application $application)
    {
        // 1. Security: Ensure the logged-in user owns this application
        if ($application->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // 2. Load relationships (Job details, Interviews, and Messages with their authors)
        $application->load(['jobPosting', 'interviews', 'messages.author']);

        return view('applicant.applications.show', compact('application'));
    }
}
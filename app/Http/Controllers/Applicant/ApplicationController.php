<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Eager load the job posting data for each application
        $applications = $user->applications()->with('jobPosting', 'interviews', 'messages.sender')->latest()->get();

        return view('applicant.applications.index', [
            'applications' => $applications,
        ]);

        //eager-load messages
        //$applications = $user->applications()->with('jobPosting', 'interviews', 'messages.sender')->latest()->get();
    }
}

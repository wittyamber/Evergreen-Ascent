<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, JobPosting $job): RedirectResponse
    {
        // 1. Authorization: Ensure user is a regular applicant
        if (Auth::user()->role !== 'applicant') {
            return back()->with('error', 'Only applicants can apply for jobs.');
        }

        // 2. Validation: Make sure a resume is uploaded
        $request->validate([
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // 2MB max
            'cover_letter' => ['nullable', 'string'],
        ]);
        
        // 3. Prevent duplicate applications
        $hasApplied = Auth::user()->applications()->where('job_posting_id', $job->id)->exists();
        if ($hasApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // 4. Store the resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // 5. Create the application record
        Auth::user()->applications()->create([
            'job_posting_id' => $job->id,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);

        // 6. Redirect back with a success message
        return redirect()->route('jobs.show', $job)->with('status', 'Your application has been submitted successfully!');
    }
}

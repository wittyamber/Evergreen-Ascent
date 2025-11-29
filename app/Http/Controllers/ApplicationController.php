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

        // 2. Validation: Resume is required, Cover Letter is an optional FILE now
        $request->validate([
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], 
            'cover_letter' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // Changed from string to file
        ]);
        
        // 3. Prevent duplicate applications
        $hasApplied = Auth::user()->applications()->where('job_posting_id', $job->id)->exists();
        if ($hasApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // 4. Store the resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // 5. Store the cover letter file (if it exists)
        $coverLetterPath = null;
        if ($request->hasFile('cover_letter')) {
            $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
        }

        // 6. Create the application record
        Auth::user()->applications()->create([
            'job_posting_id' => $job->id,
            'resume_path' => $resumePath,
            'cover_letter_path' => $coverLetterPath, // We save the path now
            'status' => 'submitted',
        ]);

        // 7. Redirect with a success message
        // Redirecting to 'my applications' is usually better UX than staying on the job page
        return redirect()->route('applicant.applications.index')
            ->with('status', 'Your application has been submitted successfully!');
    }
}
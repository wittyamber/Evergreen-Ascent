<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Interview; 
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function processRescheduleRequest(Request $request, Interview $interview)
    {
        // 1. Authorization
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        // 2. Validate the reason
        $request->validate(['reschedule_reason' => ['nullable', 'string', 'max:1000']]);

        // 3. Update the interview status to 'Cancelled'
        $interview->update(['status' => 'Cancelled']);

        // 4. Create an internal note for the HR team from the applicant
        $reason = $request->input('reschedule_reason', 'No reason provided.');
        $interview->application->notes()->create([
            'user_id' => auth()->id(), // The note is from the applicant
            'note' => "Applicant requested to reschedule.\nReason: " . $reason,
        ]);

        // 5. Redirect back with a success message
        return redirect()->route('applicant.applications.index')
                         ->with('status', 'Your reschedule request has been sent. The HR team will contact you shortly.');
    }

    public function showRescheduleForm(Interview $interview)
    {
        // Authorize that the applicant owns this interview
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        // Ensure we're not trying to reschedule a confirmed interview
        if ($interview->status !== 'Pending Confirmation') {
            return redirect()->route('applicant.applications.index')->with('error', 'This interview cannot be rescheduled at this time.');
        }

        return view('applicant.interviews.reschedule', [
            'interview' => $interview,
        ]);
    }

    public function update(Request $request, Interview $interview)
    {
        // 1. Authorization: Ensure the logged-in user owns the application.
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        // --- START: NEW LOGIC ---

        // 2. Find all OTHER 'Pending Confirmation' interviews for THIS application and cancel them.
        $interview->application->interviews()
            ->where('status', 'Pending Confirmation')
            ->where('id', '!=', $interview->id) // Exclude the one being confirmed
            ->update(['status' => 'Cancelled']);

        // --- END: NEW LOGIC ---

        // 3. Update the SELECTED interview status to 'Scheduled'
        $interview->update(['status' => 'Scheduled']);

        // 4. Update the parent application's status
        $interview->application->update(['status' => 'Interview Scheduled']);

        // 5. Redirect back to the 'My Applications' page with a success message
        return redirect()->route('applicant.applications.index')
                         ->with('status', 'Interview confirmed! The other time slots have been cancelled.');
    }
}
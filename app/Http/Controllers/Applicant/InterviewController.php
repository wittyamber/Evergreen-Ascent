<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Interview; 
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Handle the "Accept Interview" action.
     */
    public function confirm(Interview $interview)
    {
        // 1. Authorization
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        // 2. Logic: If HR sent multiple options, confirming one should cancel the others.
        // We find sibling interviews for the same application that are pending.
        $interview->application->interviews()
            ->where('status', 'Scheduled') // Assuming default status is 'Scheduled' or 'Pending'
            ->where('id', '!=', $interview->id)
            ->update(['status' => 'Cancelled']);

        // 3. Update THIS interview to Confirmed
        $interview->update(['status' => 'Confirmed']);

        // 4. Redirect back
        return back()->with('success', 'Interview confirmed successfully! We look forward to meeting you.');
    }

    /**
     * Show the form to request a change.
     */
    public function showRescheduleForm(Interview $interview)
    {
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        return view('applicant.interviews.reschedule', [
            'interview' => $interview,
        ]);
    }

    /**
     * Process the reschedule request form.
     */
    public function processRescheduleRequest(Request $request, Interview $interview)
    {
        // 1. Authorization
        if ($interview->application->user_id !== auth()->id()) {
            abort(403);
        }

        // 2. Validate inputs (Matches the Blade form names: 'reason' and 'preferred_time')
        $request->validate([
            'reason' => ['required', 'string', 'max:1000'],
            'preferred_time' => ['required', 'string', 'max:1000'],
        ]);

        // 3. Update the interview status so HR sees it's not happening
        $interview->update(['status' => 'Reschedule Requested']); 
        // Note: Make sure 'Reschedule Requested' is a valid status in your logic, 
        // or use 'Cancelled' if you prefer.

        // 4. Create an internal note for HR
        $noteContent = "⚠️ APPLICANT REQUESTED RESCHEDULE\n\n";
        $noteContent .= "Reason: " . $request->reason . "\n";
        $noteContent .= "Preferred Times: " . $request->preferred_time;

        $interview->application->notes()->create([
            'user_id' => auth()->id(),
            'note' => $noteContent,
        ]);

        // 5. Redirect back with success
        return redirect()->route('applicant.applications.index')
                         ->with('success', 'Reschedule request sent. HR has been notified.');
    }
}
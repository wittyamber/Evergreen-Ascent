<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Application; 
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon; // <-- Import Carbon for date handling
use App\Models\Interview;

class InterviewController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$applications = $user->applications()->with('jobPosting', 'interviews')->latest()->get();

        $upcomingInterviews = Interview::where('interviewer_id', auth()->id())
                                       ->where('status', 'Scheduled')
                                       ->where('scheduled_at', '>=', now())
                                       ->with('application.user', 'application.jobPosting')
                                       ->orderBy('scheduled_at', 'asc')
                                       ->get();

        return view('hr.interviews.index', [
            'interviews' => $upcomingInterviews,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Application $application)
    {
        // Authorize that the user can manage this application
        $this->authorize('update', $application->jobPosting);

        return view('hr.interviews.create', [
            'application' => $application,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Application $application)
    {
        // 1. Authorize
        $this->authorize('update', $application->jobPosting);

        // 2. Validate
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'scheduled_at_date' => ['required', 'date_format:Y-m-d'],
            'scheduled_at_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'min:15'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        // 3. Combine Date and Time into a single DateTime object
        $scheduledAt = Carbon::parse($validated['scheduled_at_date'] . ' ' . $validated['scheduled_at_time']);

        // 4. Create the Interview
        $application->interviews()->create([
            'interviewer_id' => auth()->id(), // The HR user is the interviewer
            'title' => $validated['title'],
            'scheduled_at' => $scheduledAt,
            'duration_minutes' => $validated['duration_minutes'],
            'location' => $validated['location'],
            // 'status' will default to 'Pending Confirmation'
        ]);

        // 5. Redirect back to the application details page
        if ($request->has('action_add_another')) {
            // If "Send & Add Another" was clicked
            return redirect()->route('hr.interviews.create', $application)
                            ->with('status', 'Interview slot added. Add another one below.');
        }

        // Default action for "Send & Close"
        return redirect()->route('hr.applications.show', $application)
                        ->with('status', 'Interview invitation(s) have been sent to the applicant!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application->load('user', 'notes.author', 'interviews');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        // 1. Authorization: Ensure the user can manage this interview's parent application.
        $this->authorize('update', $interview->application->jobPosting);

        // 2. Update the interview status to 'Cancelled'.
        $interview->update(['status' => 'Cancelled']);

        // 3. Create an internal note for context.
        $interview->application->notes()->create([
            'user_id' => auth()->id(),
            'note' => "Interview '" . $interview->title . "' scheduled for " . $interview->scheduled_at->format('M d, Y') . " was cancelled by HR.",
        ]);
        
        // 4. (Optional but recommended) Notify the applicant via email.
        // We will add this functionality later, but this is where it would go.
        // Mail::to($interview->application->user->email)->send(new InterviewCancelledNotification($interview));

        // 5. Redirect back with a success message.
        return redirect()->route('hr.applications.show', $interview->application)
                         ->with('status', 'The interview has been cancelled.');
    }
}

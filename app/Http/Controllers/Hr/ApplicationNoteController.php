<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicationNoteController extends Controller
{
     use AuthorizesRequests;

    public function store(Request $request, Application $application)
    {
        // Authorize that the user can update the parent job posting
        $this->authorize('update', $application->jobPosting);

        // Validate the request
        $validated = $request->validate([
            'note' => ['required', 'string'],
        ]);

        // Create the note, associating it with the application and the current user
        $application->notes()->create([
            'note' => $validated['note'],
            'user_id' => auth()->id(), // Explicitly set the author
        ]);

        // Redirect back to the application details page
        return redirect()->route('hr.applications.show', $application)->with('status', 'Note added successfully!');
    }
}

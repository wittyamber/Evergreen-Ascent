<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\NewMessageForApplicant;

class ApplicationMessageController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Application $application)
    {

        //dd('Controller method was reached!');

        $this->authorize('update', $application->jobPosting);

        $validated = $request->validate(['message' => ['required', 'string']]);

        //dd($validated);

        $application->messages()->create([
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);

        $message = $application->messages()->create([ // <-- Get the created message
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);
        
        // --- SEND THE NOTIFICATION ---
        $application->user->notify(new NewMessageForApplicant($message));
        
        // We can add an email notification to the applicant here later!

        return redirect()->route('hr.applications.show', $application)->with('status', 'Message sent to applicant.');
    }
}
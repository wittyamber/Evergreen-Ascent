<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Application from: {{ $application->user->first_name }} {{ $application->user->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Left Column: Applicant Info & Actions -->
            <div class="md:col-span-1 space-y-6">
                <!-- Applicant Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Applicant Details</h3>
                        <div class="mt-4 space-y-2 text-gray-700">
                            <p><span class="font-semibold">Name:</span> {{ $application->user->first_name }} {{ $application->user->last_name }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $application->user->email }}</p>
                            <p><span class="font-semibold">Applied for:</span> {{ $application->jobPosting->title }}</p>
                            <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="mt-4 inline-block text-ascent-blue font-semibold hover:underline">
                                Download Resume
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Update Status</h3>
                        <form method="POST" action="{{ route('hr.applications.update', $application) }}">
                            @csrf
                            @method('PUT')
                            <div class="mt-4">
                                <x-input-label for="status" value="Status" />
                                <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach (['Submitted', 'Under Review', 'Interview Scheduled', 'Offer Extended', 'Hired', 'Rejected'] as $status)
                                        <option value="{{ $status }}" @selected($application->status == $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <x-primary-button class="bg-ascent-blue hover:bg-blue-700">Update</x-primary-button>
                            </div>
                        </form>

                        @if ($application->status === 'Interview Scheduled')
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <a href="{{ route('hr.interviews.create', $application) }}" class="inline-flex items-center px-4 py-2 bg-ascent-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Set Up Interview Details
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Upcoming Interviews Card -->
                @if($application->interviews->isNotEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Upcoming Interviews</h3>
                        <div class="mt-4 space-y-4">
                            @foreach ($application->interviews as $interview)
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="font-semibold text-gray-800">{{ $interview->title }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('F d, Y \a\t h:i A') }}
                                    </p>
                                    <p class="text-sm text-gray-500">Duration: {{ $interview->duration_minutes }} minutes</p>
                                    <p class="text-sm text-gray-500">Location: {{ $interview->location }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($interview->status === 'Scheduled') bg-green-100 text-green-800
                                            @elseif($interview->status === 'Cancelled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $interview->status }}
                                        </span>

                                         <!-- CANCEL INTERVIEW -->
                                        <div>
                                            @if($interview->status !== 'Cancelled')
                                                <form method="POST" action="{{ route('hr.interviews.destroy', $interview) }}" onsubmit="return confirm('Are you sure you want to cancel this interview?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-red-500 hover:underline font-semibold">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Cover Letter & Notes -->
            <div class="md:col-span-2 space-y-6">
                <!-- Cover Letter -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Cover Letter</h3>
                        <div class="mt-4 text-gray-700 whitespace-pre-wrap">
                            {{ $application->cover_letter ?? 'No cover letter submitted.' }}
                        </div>
                    </div>
                </div>

                <!-- Internal Notes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Internal Notes</h3>
                        
                        <div class="mt-4 space-y-4">
                            @forelse ($application->notes as $note)
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-sm text-gray-700">{{ $note->note }}</p>
                                    <p class="text-xs text-right text-gray-500 mt-2">
                                        - {{ $note->author->first_name }} on {{ $note->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No notes yet.</p>
                            @endforelse
                        </div>

                        <form method="POST" action="{{ route('hr.applications.notes.store', $application) }}" class="mt-6">
                            @csrf
                            <x-input-label for="note" value="Add a new note" />
                            <textarea name="note" id="note" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                            <x-primary-button class="mt-2 bg-ascent-blue hover:bg-blue-700">Add Note</x-primary-button>
                        </form>
                    </div>
                </div>

                <!-- Send Message to Applicant -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Send Message to Applicant</h3>
                        <form method="POST" action="{{ route('hr.applications.messages.store', $application) }}" class="mt-4">
                            @csrf
                            <x-input-label for="message" :value="__('Your message')" />
                            <textarea name="message" id="message" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            <x-primary-button class="mt-2 bg-ascent-blue">Send Message</x-primary-button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
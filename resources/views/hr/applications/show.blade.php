<x-app-layout>
    <!-- 1. PROFILE HEADER -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex items-center">
                    <!-- Avatar -->
                    <div class="h-20 w-20 rounded-full bg-emerald-600 flex items-center justify-center text-white text-3xl font-bold ring-4 ring-emerald-50">
                        {{ substr($application->user->first_name, 0, 1) }}{{ substr($application->user->last_name, 0, 1) }}
                    </div>
                    
                    <div class="ml-6">
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $application->user->first_name }} {{ $application->user->last_name }}
                        </h1>
                        <div class="mt-1 flex flex-col sm:flex-row sm:items-center text-sm text-gray-500 gap-4">
                            <span class="flex items-center">
                                <svg class="mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $application->user->email }}
                            </span>
                            <span class="flex items-center">
                                <svg class="mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Applied for: <span class="font-semibold text-emerald-700 ml-1">{{ $application->jobPosting->title }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 md:mt-0 flex gap-3">
                    @if($application->resume_path)
                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download Resume
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN CONTENT GRID -->
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LEFT COLUMN: Actions & Status -->
            <div class="space-y-8">
                
                <!-- Status Card -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 font-semibold text-gray-900">
                        Application Status
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('hr.applications.update', $application) }}">
                            @csrf
                            @method('PUT')
                            
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Current Stage</label>
                            <select name="status" id="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                                @foreach (['Submitted', 'Under Review', 'Interview Scheduled', 'Offer Extended', 'Hired', 'Rejected'] as $status)
                                    <option value="{{ $status }}" @selected($application->status == $status)>{{ $status }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Update Status
                            </button>
                        </form>

                        <!-- Conditional CTA: Schedule Interview -->
                        @if ($application->status === 'Interview Scheduled')
                            <div class="mt-6 p-4 bg-purple-50 rounded-lg border border-purple-100 text-center">
                                <p class="text-sm text-purple-800 mb-3 font-medium">Ready to meet?</p>
                                <a href="{{ route('hr.interviews.create', $application) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 w-full justify-center">
                                    📅 Schedule Interview
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Interviews Card -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 font-semibold text-gray-900 flex justify-between items-center">
                        <span>Interview Schedule</span>
                        @if($application->interviews->isNotEmpty())
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full">{{ $application->interviews->count() }}</span>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        @if($application->interviews->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($application->interviews as $interview)
                                    <div class="relative pl-4 border-l-2 {{ $interview->status === 'Cancelled' ? 'border-red-300' : 'border-emerald-500' }}">
                                        <p class="text-sm font-bold text-gray-900">{{ $interview->title }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('M d, Y @ h:i A') }}</p>
                                        <p class="text-xs text-gray-500 mt-1 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $interview->location }}
                                        </p>
                                        
                                        <div class="mt-2 flex items-center justify-between">
                                            <span class="px-2 py-0.5 text-xs font-medium rounded-full
                                                @if($interview->status === 'Scheduled') bg-green-100 text-green-800
                                                @elseif($interview->status === 'Cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ $interview->status }}
                                            </span>

                                            @if($interview->status !== 'Cancelled')
                                                <form method="POST" action="{{ route('hr.interviews.destroy', $interview) }}" onsubmit="return confirm('Cancel this interview?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700">Cancel</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No interviews scheduled yet.</p>
                        @endif
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Cover Letter Section -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Cover Letter
                    </h3>
                    
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        @if($application->cover_letter_path)
                            <!-- If file exists, show download button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Cover_Letter.pdf</p>
                                        <p class="text-xs text-gray-500">Attached document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->cover_letter_path) }}" target="_blank" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                    Download
                                </a>
                            </div>
                        @elseif($application->cover_letter)
                            <!-- Fallback for old applications (Text) -->
                            <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap font-serif">
                                {{ $application->cover_letter }}
                            </div>
                        @else
                            <p class="text-sm text-gray-500 italic">No cover letter submitted.</p>
                        @endif
                    </div>
                </div>

                <!-- 2. Internal Notes (Timeline Style) -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900">Internal Notes</h3>
                        <span class="text-xs text-gray-500">Only visible to HR Team</span>
                    </div>
                    <div class="p-8">
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @forelse ($application->notes as $note)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center ring-8 ring-white">
                                                    <span class="text-white text-xs font-bold">{{ substr($note->author->first_name, 0, 1) }}</span>
                                                </div>
                                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $note->note }}
                                                        </p>
                                                    </div>
                                                    <div class="whitespace-nowrap text-right text-xs text-gray-500">
                                                        <time datetime="{{ $note->created_at }}">{{ $note->created_at->format('M d') }}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-sm text-gray-500 italic mb-6">No notes added yet.</p>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Add Note Form -->
                        <div class="mt-8 flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    {{ substr(Auth::user()->first_name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-grow">
                                <form method="POST" action="{{ route('hr.applications.notes.store', $application) }}">
                                    @csrf
                                    <textarea name="note" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Add a private note..."></textarea>
                                    <div class="mt-2 flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none">
                                            Post Note
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Send Message -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-900">Email Applicant</h3>
                    </div>
                    <div class="p-8">
                        <form method="POST" action="{{ route('hr.applications.messages.store', $application) }}">
                            @csrf
                            <div>
                                <label for="message" class="sr-only">Message</label>
                                <textarea id="message" name="message" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Write a message to {{ $application->user->first_name }}..."></textarea>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none">
                                    Send Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application Details') }}
            </h2>
            <a href="{{ route('applicant.applications.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Back to My Applications
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- LEFT COLUMN: Job Context & Status -->
                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white shadow-sm rounded-xl border-t-4 border-emerald-500 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">{{ $application->jobPosting->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $application->jobPosting->location }}</p>
                            
                            <div class="mt-6">
                                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Current Status</span>
                                @php
                                    $statusClass = match($application->status) {
                                        'submitted', 'pending' => 'bg-yellow-100 text-yellow-800',
                                        'reviewed' => 'bg-blue-100 text-blue-800',
                                        'interview_scheduled' => 'bg-purple-100 text-purple-800',
                                        'hired', 'offer' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $statusClass }}">
                                    {{ str_replace('_', ' ', $application->status) }}
                                </span>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <p class="text-xs text-gray-400">Application ID: #{{ $application->id }}</p>
                                <p class="text-xs text-gray-400">Submitted: {{ $application->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Interview Alert (If exists) -->
                    @foreach($application->interviews as $interview)
                        @if($interview->status === 'Scheduled' && $interview->scheduled_at > now())
                            <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow-sm">
                                <h4 class="font-bold text-purple-900 mb-2">Upcoming Interview</h4>
                                <p class="text-sm text-purple-800 mb-1">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('M d, Y') }}
                                </p>
                                <p class="text-sm text-purple-800 mb-4">
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('h:i A') }}
                                </p>
                                <a href="{{ route('applicant.interviews.reschedule.show', $interview) }}" class="text-sm text-purple-600 underline hover:text-purple-900">
                                    Request Reschedule
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- RIGHT COLUMN: Message History -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 h-full flex flex-col">
                        
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Messages from HR</h3>
                            <span class="text-xs text-gray-500">
                                {{ $application->messages->count() }} message(s)
                            </span>
                        </div>

                        <!-- Message Stream -->
                        <div class="p-6 flex-1 overflow-y-auto max-h-[600px] space-y-6">
                            @forelse ($application->messages as $message)
                                <div class="flex gap-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold border border-emerald-200">
                                            {{ substr($message->author->first_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <!-- Bubble -->
                                    <div class="flex-1">
                                        <div class="bg-gray-50 rounded-2xl rounded-tl-none px-5 py-3 border border-gray-100 shadow-sm inline-block max-w-lg">
                                            <p class="text-sm font-bold text-gray-900 mb-1">
                                                {{ $message->author->first_name }} (HR Team)
                                            </p>
                                            <p class="text-gray-700 text-sm whitespace-pre-wrap leading-relaxed">{{ $message->message }}</p>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1 ml-2">
                                            {{ $message->created_at->format('M d, h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="bg-gray-50 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                                        <svg class="h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    </div>
                                    <p class="text-gray-500 text-sm">No messages received yet.</p>
                                    <p class="text-gray-400 text-xs mt-1">HR will contact you here if they need more information.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Footer (Optional: If you want to allow replies later) -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center">
                            <p class="text-xs text-gray-400">
                                This message thread is managed by the Talent Acquisition Team.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
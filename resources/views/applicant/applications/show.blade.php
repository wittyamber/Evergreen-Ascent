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
                
                <!-- LEFT COLUMN: Status & Actions -->
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
                                        'Submitted', 'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Under Review', 'Reviewed' => 'bg-blue-100 text-blue-800',
                                        'Interview Scheduled' => 'bg-purple-100 text-purple-800',
                                        'Offer Extended', 'Hired' => 'bg-green-100 text-green-800',
                                        'Rejected' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $statusClass }}">
                                    {{ $application->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Interview Actions Area -->
                    @foreach($application->interviews as $interview)
                        <!-- LOGIC FIX: Show if NOT Cancelled and IS Future -->
                        @if($interview->status !== 'Cancelled' && $interview->scheduled_at->isFuture())
                            
                            <div class="bg-white border rounded-xl shadow-sm overflow-hidden mb-6 {{ $interview->status === 'Confirmed' ? 'border-emerald-200' : 'border-purple-200 ring-2 ring-purple-100' }}">
                                
                                <!-- Header -->
                                <div class="px-5 py-3 border-b flex justify-between items-center {{ $interview->status === 'Confirmed' ? 'bg-emerald-50 border-emerald-100' : 'bg-purple-50 border-purple-100' }}">
                                    <h4 class="font-bold {{ $interview->status === 'Confirmed' ? 'text-emerald-900' : 'text-purple-900' }}">
                                        {{ $interview->status === 'Confirmed' ? '✅ Confirmed' : '📅 Action Required' }}
                                    </h4>
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $interview->status === 'Confirmed' ? 'bg-emerald-200 text-emerald-800' : 'bg-purple-200 text-purple-800' }}">
                                        {{ $interview->status }}
                                    </span>
                                </div>

                                <!-- Details -->
                                <div class="p-5">
                                    <p class="text-sm text-gray-900 font-semibold mb-2">{{ $interview->title }}</p>
                                    
                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <p class="flex items-center">
                                            <span class="w-16 text-xs font-bold text-gray-400 uppercase">When</span>
                                            {{ $interview->scheduled_at->format('M d, Y @ h:i A') }}
                                        </p>
                                        <p class="flex items-center">
                                            <span class="w-16 text-xs font-bold text-gray-400 uppercase">Duration</span>
                                            {{ $interview->duration_minutes }} mins
                                        </p>
                                        <p class="flex items-center">
                                            <span class="w-16 text-xs font-bold text-gray-400 uppercase">Where</span>
                                            {{ $interview->location }}
                                        </p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-2">
                                        @if($interview->status !== 'Confirmed')
                                            <!-- Confirm Button -->
                                            <form method="POST" action="{{ route('applicant.interviews.confirm', $interview) }}" class="flex-1">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 transition">
                                                    Accept
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Reschedule Button -->
                                        <a href="{{ route('applicant.interviews.reschedule.show', $interview) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                            {{ $interview->status === 'Confirmed' ? 'Reschedule' : 'Request Change' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- RIGHT COLUMN: Messages -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 h-full flex flex-col min-h-[500px]">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-bold text-gray-800">Messages</h3>
                        </div>
                        <div class="p-6 flex-1 overflow-y-auto space-y-6">
                            @forelse ($application->messages as $message)
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold">
                                            {{ substr($message->author->first_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="bg-gray-50 rounded-2xl rounded-tl-none px-5 py-3 border border-gray-100 shadow-sm inline-block">
                                            <p class="text-sm font-bold text-gray-900 mb-1">{{ $message->author->first_name }}</p>
                                            <p class="text-gray-700 text-sm whitespace-pre-wrap">{{ $message->message }}</p>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1 ml-2">{{ $message->created_at->format('M d, h:i A') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-400">
                                    <p>No messages received yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
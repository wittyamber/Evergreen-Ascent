<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="space-y-4">
                @forelse ($applications as $application)
                    <!-- Card Container with Alpine.js State -->
                    <div x-data="{ expanded: false }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 transition duration-200">
                        
                        <!-- 1. Clickable Header (Always Visible) -->
                        <div @click="expanded = ! expanded" class="p-6 cursor-pointer hover:bg-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            
                            <!-- Job Info -->
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    {{ $application->jobPosting->title }}
                                    <!-- Indicator if Interview is scheduled -->
                                    @if($application->status === 'interview_scheduled')
                                        <span class="flex h-2 w-2 relative">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                                        </span>
                                    @endif
                                </h3>
                                <div class="text-sm text-gray-500 mt-1 flex items-center gap-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $application->jobPosting->location }}
                                    </span>
                                    <span class="text-gray-300">|</span>
                                    <span>Applied {{ $application->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Right Side: Status & Chevron -->
                            <div class="flex items-center gap-4">
                                <!-- Status Badge -->
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
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusClass }}">
                                    {{ str_replace('_', ' ', $application->status) }}
                                </span>

                                <!-- Animated Chevron -->
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" 
                                     :class="{'rotate-180': expanded}" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- 2. Collapsible Details (Hidden by default) -->
                        <div x-show="expanded" 
                             x-collapse 
                             class="bg-gray-50 border-t border-gray-100">
                            
                            <div class="p-6 grid gap-6">
                                
                                <!-- Interview Alert (Only shows if applicable) -->
                                @foreach($application->interviews as $interview)
                                    @if($interview->status !== 'Cancelled' && $interview->scheduled_at > now())
                                        <div class="bg-white border-l-4 border-purple-500 p-4 rounded shadow-sm">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-bold text-purple-900">📅 Interview Scheduled</p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        {{ $interview->title }} on {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('F j, Y \a\t h:i A') }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('applicant.interviews.reschedule.show', $interview) }}" class="text-sm text-purple-600 font-semibold hover:underline">
                                                    Reschedule?
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <!-- Action Bar -->
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500 italic">
                                        Last updated {{ $application->updated_at->diffForHumans() }}
                                    </div>
                                    
                                    <!-- The Primary Button to go to the Full Message Page -->
                                    <a href="{{ route('applicant.applications.show', $application) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none transition ease-in-out duration-150">
                                        View Full Details & Messages
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-20 bg-white rounded-lg shadow-sm border border-gray-100">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No applications found</h3>
                        <p class="mt-1 text-sm text-gray-500">You haven't applied for any jobs yet.</p>
                        <div class="mt-6">
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none">
                                Browse Open Jobs
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
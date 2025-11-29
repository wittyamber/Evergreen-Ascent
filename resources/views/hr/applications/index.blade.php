<x-app-layout>
    <!-- 1. Header Section -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-sm text-gray-500 mb-1">
                        <a href="{{ route('hr.jobs.index') }}" class="hover:text-emerald-600 hover:underline">Posted Jobs</a>
                        <svg class="h-4 w-4 mx-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        <span>{{ $job->title }}</span>
                    </div>
                    <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                        Applicants
                        <span class="ml-2 inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-sm font-medium text-emerald-800">
                            {{ $applications->count() }}
                        </span>
                    </h2>
                </div>
                <!-- Optional: Filter Button could go here later -->
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Applicants List -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <ul role="list" class="divide-y divide-gray-100">
                    @forelse ($applications as $application)
                        <li class="hover:bg-gray-50 transition duration-150">
                            <a href="{{ route('hr.applications.show', $application) }}" class="block px-6 py-5">
                                <div class="flex items-center justify-between">
                                    
                                    <!-- Left: Candidate Info -->
                                    <div class="flex items-center">
                                        <!-- Avatar / Initials -->
                                        <div class="flex-shrink-0">
                                            <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-lg border-2 border-white shadow-sm">
                                                {{ substr($application->user->first_name, 0, 1) }}{{ substr($application->user->last_name, 0, 1) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Name & Meta -->
                                        <div class="ml-4">
                                            <div class="flex items-center">
                                                <p class="text-lg font-bold text-gray-900">
                                                    {{ $application->user->first_name }} {{ $application->user->last_name }}
                                                </p>
                                                <!-- New Badge (if applied recently) -->
                                                @if($application->created_at->diffInDays() < 3)
                                                    <span class="ml-2 inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">New</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500 mt-1">
                                                <svg class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                                {{ $application->user->email }}
                                                <span class="mx-2">&bull;</span>
                                                <span>Applied {{ $application->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right: Status & Chevron -->
                                    <div class="flex items-center gap-6">
                                        <!-- Color Coded Status Badge -->
                                        @php
                                            $statusClasses = match($application->status) {
                                                'submitted', 'pending' => 'bg-yellow-100 text-yellow-800',
                                                'reviewed' => 'bg-blue-100 text-blue-800',
                                                'interview_scheduled', 'interview' => 'bg-purple-100 text-purple-800',
                                                'hired', 'offer' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $statusClasses }}">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>

                                        <div class="flex items-center text-emerald-600 text-sm font-semibold group-hover:text-emerald-800">
                                            Review
                                            <svg class="ml-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No applicants yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Wait for candidates to apply for this position.</p>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
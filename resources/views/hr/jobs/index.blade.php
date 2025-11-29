<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Manage Job Postings') }}
            </h2>
            
            <a href="{{ route('hr.jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post New Job
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="space-y-6">
                @forelse ($jobs as $job)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 {{ $job->status === 'Active' ? 'border-emerald-500' : 'border-gray-300' }} hover:shadow-md transition duration-200">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                
                                <!-- Job Details -->
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ $job->title }}
                                        </h3>
                                        
                                        <!-- Status Badge -->
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                            {{ $job->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $job->status }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-2 text-sm text-gray-500 flex flex-wrap items-center gap-4">
                                        <span class="flex items-center">
                                            <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $job->location }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            {{ $job->type }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            Posted {{ $job->created_at->format('M d, Y') }}
                                        </span>
                                    </div>

                                    @if($job->salary_range)
                                        <div class="mt-2 text-sm text-gray-600 font-medium">
                                            💰 {{ $job->salary_range }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Applicant Count (Hero Statistic) -->
                                <div class="flex-shrink-0 text-center px-4 border-l border-gray-100 hidden md:block">
                                    <span class="block text-2xl font-bold {{ $job->applications_count > 0 ? 'text-emerald-600' : 'text-gray-400' }}">
                                        {{ $job->applications_count }}
                                    </span>
                                    <span class="text-xs text-gray-500 uppercase tracking-wider">Applicants</span>
                                </div>

                                <!-- Actions Toolbar -->
                                <div class="flex items-center gap-3 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6">
                                    
                                    <!-- 1. View Applicants (Primary) -->
                                    <a href="{{ route('hr.jobs.applications.index', $job) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        Applicants
                                        @if($job->applications_count > 0)
                                            <span class="ml-2 bg-emerald-100 text-emerald-800 text-xs font-semibold px-2 py-0.5 rounded-full">
                                                {{ $job->applications_count }}
                                            </span>
                                        @endif
                                    </a>

                                    <!-- 2. Quick Edit -->
                                    <a href="{{ route('hr.jobs.edit', $job) }}" class="p-2 text-gray-400 hover:text-indigo-600 transition rounded-full hover:bg-indigo-50" title="Edit Job">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- 3. Public View -->
                                    <a href="{{ route('jobs.show', $job) }}" target="_blank" class="p-2 text-gray-400 hover:text-blue-600 transition rounded-full hover:bg-blue-50" title="View Public Listing">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>

                                    <!-- 4. Delete -->
                                    <form method="POST" action="{{ route('hr.jobs.destroy', $job) }}" onsubmit="return confirm('Are you sure? This will delete all applications associated with this job.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition rounded-full hover:bg-red-50" title="Delete Job">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            
                            <!-- Quick Status Toggle (Footer of card) -->
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center text-xs">
                                <div class="text-gray-500">
                                    Last updated {{ $job->updated_at->diffForHumans() }}
                                </div>
                                <form action="{{ route('hr.jobs.update', $job) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="title" value="{{ $job->title }}">
                                    <input type="hidden" name="location" value="{{ $job->location }}">
                                    <input type="hidden" name="type" value="{{ $job->type }}">
                                    <input type="hidden" name="description" value="{{ $job->description }}">
                                    
                                    <input type="hidden" name="status" value="{{ $job->status === 'Active' ? 'Draft' : 'Active' }}">
                                    <button type="submit" class="font-semibold {{ $job->status === 'Active' ? 'text-red-500 hover:text-red-700' : 'text-emerald-600 hover:text-emerald-700' }}">
                                        {{ $job->status === 'Active' ? 'Unpublish (Set to Draft)' : 'Publish Now (Set to Active)' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-24 bg-white rounded-lg border border-gray-200 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No jobs posted</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new job opening.</p>
                        <div class="mt-6">
                            <a href="{{ route('hr.jobs.create') }}" class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                                Create Job
                            </a>
                        </div>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
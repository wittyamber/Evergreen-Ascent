<x-app-layout>
    <!-- 1. HEADER & STATS SECTION -->
    <div class="bg-emerald-900 pb-32 pt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-white sm:truncate sm:text-3xl sm:tracking-tight">
                        Welcome back, {{ Auth::user()->first_name }}
                    </h2>
                    <p class="mt-1 text-emerald-100">
                        Here's what's happening with your recruitment pipeline today.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a href="{{ route('hr.jobs.create') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-emerald-900 shadow-sm hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-emerald-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Post New Job
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-3">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 bg-emerald-100 text-emerald-600 rounded-md flex items-center justify-center">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Active Jobs</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $activeJobs ?? 0 }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 bg-blue-100 text-blue-600 rounded-md flex items-center justify-center">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Total Applicants</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $totalApplicants ?? 0 }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 bg-yellow-100 text-yellow-600 rounded-md flex items-center justify-center">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Pending Review</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $pendingReviews ?? 0 }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN CONTENT AREA -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10 pb-12">
        
        <!-- Status Message -->
        @if (session('status'))
            <div class="rounded-md bg-green-50 p-4 mb-6 border-l-4 border-green-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg sm:rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Your Job Postings</h3>
                <span class="px-3 py-1 text-xs font-semibold text-gray-600 bg-white border rounded-full shadow-sm">
                    Total: {{ $jobPostings->count() }}
                </span>
            </div>

            <ul role="list" class="divide-y divide-gray-100">
                @forelse ($jobPostings as $job)
                    <li class="hover:bg-gray-50 transition duration-150">
                        <div class="px-6 py-5 sm:flex sm:items-center sm:justify-between">
                            
                            <!-- Left: Job Info -->
                            <div class="sm:flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <p class="truncate text-lg font-bold text-emerald-900">{{ $job->title }}</p>
                                        <!-- Status Badge (Toggle Form) -->
                                        <form action="{{ route('hr.jobs.update', $job) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Hidden inputs to preserve data -->
                                            <input type="hidden" name="title" value="{{ $job->title }}">
                                            <input type="hidden" name="location" value="{{ $job->location }}">
                                            <input type="hidden" name="type" value="{{ $job->type }}">
                                            <input type="hidden" name="description" value="{{ $job->description }}">
                                            <input type="hidden" name="status" value="{{ $job->status === 'Active' ? 'Draft' : 'Active' }}">
                                            
                                            <button type="submit" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium cursor-pointer transition
                                                {{ $job->status === 'Active' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                                <span class="{{ $job->status === 'Active' ? 'bg-green-400' : 'bg-gray-400' }} -ml-0.5 mr-1.5 h-2 w-2 rounded-full" aria-hidden="true"></span>
                                                {{ $job->status }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-1">
                                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.006.004.003.001a.75.75 0 01-.01-1.431l-.004-.001-.06-.03a9.256 9.256 0 01-.735-.408 11.373 11.373 0 01-1.778-1.377C4.69 14.35 3 12.21 3 9a7 7 0 1114 0c0 3.21-1.69 5.35-3.196 6.787a11.376 11.376 0 01-1.777 1.377 9.266 9.266 0 01-.736.408l-.06.03-.004.001a.75.75 0 01-.01 1.431z" clip-rule="evenodd" /></svg>
                                    {{ $job->location }}
                                    <span class="mx-2">&bull;</span>
                                    {{ $job->type }}
                                    <span class="mx-2">&bull;</span>
                                    Posted {{ $job->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <!-- Right: Actions -->
                            <div class="mt-4 flex flex-shrink-0 items-center gap-4 sm:ml-5 sm:mt-0">
                                
                                <!-- 1. View Applicants Button (Prominent) -->
                                <a href="{{ route('hr.jobs.applications.index', $job) }}" 
                                   class="inline-flex items-center gap-2 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Applicants
                                </a>

                                <!-- 2. Icon Group for Edit/View/Delete -->
                                <div class="flex items-center gap-2 border-l border-gray-200 pl-4">
                                    <a href="{{ route('hr.jobs.edit', $job) }}" class="p-2 text-gray-400 hover:text-indigo-600 transition" title="Edit Job">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    </a>
                                    
                                    <a href="{{ route('jobs.show', $job) }}" class="p-2 text-gray-400 hover:text-blue-600 transition" title="View Public Listing" target="_blank">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                    </a>

                                    <form method="POST" action="{{ route('hr.jobs.destroy', $job) }}" onsubmit="return confirm('Delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition" title="Delete Job">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </li>
                @empty
                    <li class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No jobs posted yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new job opening.</p>
                        <div class="mt-6">
                            <a href="{{ route('hr.jobs.create') }}" class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                                Create Job
                            </a>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
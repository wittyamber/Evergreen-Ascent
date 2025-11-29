<x-public-layout>
    
    <!-- Page Header (To match the corporate feel) -->
    <div class="bg-gray-100 border-b border-gray-200 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-emerald-900">
                Join Our Team
            </h1>
            <p class="mt-2 text-lg text-gray-600">
                Explore open positions at {{ \App\Models\SystemSetting::get('site_name', 'Evergreen Solutions') }}
            </p>
        </div>
    </div>

    <!-- Job Listings Container -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Check if there are jobs -->
            @if($jobs->count() > 0)
                <div class="grid gap-6">
                    @foreach($jobs as $job)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 hover:shadow-md transition duration-200">
                            <div class="p-6 md:flex md:items-center md:justify-between">
                                
                                <!-- Job Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center mb-2">
                                        <h2 class="text-xl font-bold text-gray-900 leading-7 sm:truncate sm:text-2xl sm:tracking-tight">
                                            {{ $job->title }}
                                        </h2>
                                        
                                        <!-- Job Type Badge -->
                                        <span class="ml-3 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium 
                                            {{ $job->type == 'full-time' ? 'bg-blue-100 text-blue-800' : 
                                              ($job->type == 'part-time' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucwords(str_replace('-', ' ', $job->type)) }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                                        <!-- Location -->
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $job->location ?? 'Remote / Hybrid' }}
                                        </div>

                                        <!-- Salary (Optional) -->
                                        @if($job->salary_range)
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $job->salary_range }}
                                        </div>
                                        @endif

                                        <!-- Posted Date -->
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Posted {{ $job->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-4 flex md:mt-0 md:ml-4">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-emerald-600 bg-white border-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                                        View Details & Apply &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $jobs->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20 bg-white rounded-lg shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No positions open right now</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for new opportunities.</p>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>
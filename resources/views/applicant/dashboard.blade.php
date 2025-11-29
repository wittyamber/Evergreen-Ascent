<x-app-layout>
    <!-- Welcome Header -->
    <div class="bg-emerald-900 pb-24 pt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white">
                Hello, {{ Auth::user()->first_name }}!
            </h2>
            <p class="mt-2 text-emerald-100">
                Welcome to your career command center. Track your applications and next steps here.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10 pb-12">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white overflow-hidden rounded-xl shadow-md p-6 flex items-center border-l-4 border-emerald-500">
                <div class="p-3 bg-emerald-100 rounded-full text-emerald-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Applications Submitted</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $applicationsCount ?? 0 }}</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white overflow-hidden rounded-xl shadow-md p-6 flex items-center border-l-4 border-purple-500">
                <div class="p-3 bg-purple-100 rounded-full text-purple-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Upcoming Interviews</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $interviewsCount ?? 0 }}</p>
                </div>
            </div>

            <!-- Card 3: Action -->
            <a href="{{ route('jobs.index') }}" class="bg-gradient-to-r from-emerald-600 to-teal-500 overflow-hidden rounded-xl shadow-md p-6 flex items-center justify-between text-white hover:shadow-lg transition transform hover:scale-[1.02]">
                <div>
                    <p class="text-lg font-bold">Browse Open Jobs</p>
                    <p class="text-sm text-emerald-100">Find your next opportunity</p>
                </div>
                <svg class="w-8 h-8 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Next Steps</h3>
            </div>
            <div class="p-6">
                @if(($interviewsCount ?? 0) > 0)
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4 flex items-start">
                        <svg class="w-6 h-6 text-purple-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h4 class="font-bold text-purple-900">You have an upcoming interview!</h4>
                            <p class="text-sm text-purple-700 mt-1">Check your "My Applications" tab to view details and prepare.</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No pending actions. Keep applying!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
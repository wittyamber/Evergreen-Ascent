<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-4 text-sm text-gray-500">
                <a href="{{ route('hr.applications.show', $application) }}" class="hover:text-emerald-600">
                    &larr; Back to {{ $application->user->first_name }}'s Application
                </a>
            </nav>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                
                <!-- Header -->
                <div class="px-8 py-6 bg-emerald-900 text-white">
                    <h2 class="text-2xl font-bold">Schedule Interview</h2>
                    <p class="text-emerald-200 mt-1">
                        Candidate: <span class="text-white font-semibold">{{ $application->user->first_name }} {{ $application->user->last_name }}</span>
                    </p>
                    <p class="text-emerald-200 text-sm">
                        Position: {{ $application->jobPosting->title }}
                    </p>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('hr.interviews.store', $application) }}"> 
                        @csrf
                        
                        <!-- 1. What -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Event Details</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="title" value="Interview Type" />
                                    <input type="text" id="title" name="title" list="interview_types" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" placeholder="e.g. Technical Screening" required>
                                    <datalist id="interview_types">
                                        <option value="Initial Screening">
                                        <option value="Technical Interview">
                                        <option value="Manager Interview">
                                        <option value="Final Culture Fit">
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <!-- 2. When -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Timing</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="scheduled_at_date" value="Date" />
                                    <input type="date" id="scheduled_at_date" name="scheduled_at_date" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <x-input-label for="scheduled_at_time" value="Start Time" />
                                    <input type="time" id="scheduled_at_time" name="scheduled_at_time" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <x-input-label for="duration_minutes" value="Duration (Minutes)" />
                                    <select name="duration_minutes" id="duration_minutes" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                        <option value="15">15 min</option>
                                        <option value="30" selected>30 min</option>
                                        <option value="45">45 min</option>
                                        <option value="60">1 Hour</option>
                                        <option value="90">1.5 Hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Where -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Location</h3>
                            <div>
                                <x-input-label for="location" value="Meeting Link / Address" />
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        📍
                                    </span>
                                    <input type="text" name="location" id="location" class="focus:ring-emerald-500 focus:border-emerald-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="e.g. Google Meet Link or Office Room 3B" required>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                            <button type="button" onclick="history.back()" class="text-sm text-gray-500 hover:text-gray-700">Cancel</button>
                            
                            <div class="flex space-x-3">
                                <button type="submit" name="action_add_another" value="true" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Save & Add Another
                                </button>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Confirm Schedule
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
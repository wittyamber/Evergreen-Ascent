<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Upcoming Interviews Section -->
            @if($upcomingInterviews->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Upcoming Interviews</h3>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 space-y-4">
                            @foreach($upcomingInterviews as $interview)
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <p class="font-bold text-ascent-blue">{{ $interview->title }}</p>
                                    <p>For position: {{ $interview->application->jobPosting->title }}</p>
                                    <p class="mt-2 font-semibold">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F jS, Y') }}</p>
                                    <p>{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('h:i A') }} ({{ $interview->duration_minutes }} minutes)</p>
                                    <p class="text-sm mt-1">Location: {{ $interview->location }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Welcome Message / Other Widgets -->
            <!-- Active Applications Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Active Applications</h3>
                
                @forelse ($applications as $application)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900">
                            <h4 class="font-bold text-lg">{{ $application->jobPosting->title }}</h4>
                            <p class="text-sm text-gray-500 mb-6">Applied on: {{ $application->created_at->format('M d, Y') }}</p>

                            @php
                                $baseStatuses = ['Submitted', 'Under Review', 'Interview Scheduled'];
                                $isFinalState = in_array($application->status, ['Hired', 'Offer Extended', 'Rejected']);
                                
                                // Determine the current step index
                                $currentStatusIndex = array_search($application->status, $baseStatuses);
                                if ($currentStatusIndex === false && $isFinalState) {
                                    $currentStatusIndex = count($baseStatuses); // If hired/rejected, all base steps are complete
                                }

                                // Define the final, visible steps for the timeline
                                $timelineStatuses = $baseStatuses;
                                if ($application->status === 'Hired' || $application->status === 'Offer Extended') {
                                    $timelineStatuses[] = 'Hired';
                                } elseif ($application->status === 'Rejected') {
                                    $timelineStatuses[] = 'Rejected';
                                }
                            @endphp

                            <!-- Timeline -->
                            <div class="flex items-center">
                                @foreach ($timelineStatuses as $index => $status)
                                    @php
                                        $isCompleted = $currentStatusIndex > $index;
                                        $isCurrent = $currentStatusIndex === $index;
                                        $isRejected = ($status === 'Rejected' && $isCurrent);
                                    @endphp
                                    
                                    <!-- Step Circle and Text -->
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                                            @if($isRejected) bg-red-500 text-white
                                            @elseif($currentStatusIndex >= $index) bg-green-500 text-white
                                            @else bg-gray-200 text-gray-500 @endif">
                                            
                                            @if($isRejected)
                                                <!-- Cross for rejected -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            @elseif($isCompleted)
                                                <!-- Checkmark for completed -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                <!-- Number for current/future -->
                                                {{ $index + 1 }}
                                            @endif
                                        </div>
                                        <p class="text-xs mt-2 text-center w-24 
                                            @if($isRejected) text-red-500 font-semibold
                                            @elseif($currentStatusIndex >= $index) text-green-600 font-semibold
                                            @else text-gray-500 @endif">{{ $status }}</p>
                                    </div>

                                    <!-- Connecting Line -->
                                    @if (!$loop->last)
                                        <div class="flex-1 h-1 mx-2 @if ($isCompleted) bg-green-500 @else bg-gray-200 @endif"></div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p>You have no active applications. <a href="{{ route('jobs.index') }}" class="text-ascent-blue font-semibold hover:underline">Explore open positions</a> to get started!</p>
                        </div>
                    </div>
                @endforelse

                <div class="mt-6 text-center">
                    <a href="{{ route('applicant.applications.index') }}" class="text-sm font-semibold text-gray-600 hover:text-ascent-blue hover:underline">View All Applications (including Hired/Rejected) &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($applications as $application)
                        <!-- NEW: Alpine.js data container for each application -->
                        <div x-data="{ open: false }" class="p-6 @unless($loop->last) border-b dark:border-gray-700 @endunless">
                            <!-- Top section - ALWAYS VISIBLE -->
                            <div class="flex justify-between items-center">
                                <!-- Left Side: Job Title & Date -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">{{ $application->jobPosting->title }}</h3>
                                    <p class="text-sm text-gray-500">Applied on: {{ $application->created_at->format('M d, Y') }}</p>
                                </div>
                                <!-- Middle: Status Badge -->
                                <div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if(in_array($application->status, ['Hired', 'Offer Extended'])) bg-green-100 text-green-800
                                        @elseif($application->status == 'Rejected') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ $application->status }}
                                    </span>
                                </div>
                                <!-- NEW: Toggle Button -->
                                <div class="ml-4">
                                    <button @click="open = !open" class="text-gray-500 hover:text-ascent-blue">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                            class="w-6 h-6 transition-transform duration-300" :class="{ 'rotate-180': open }">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- NEW: Collapsible wrapper for details -->
                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translateY-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translateY-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="mt-4 pt-4 border-t">

                            <!-- Interview Invitation Block (Action Required) -->
                            @if($application->interviews->where('status', 'Pending Confirmation')->isNotEmpty())
                                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <h4 class="font-semibold text-yellow-800">Action Required: Interview Invitation</h4>
                                    @foreach($application->interviews->where('status', 'Pending Confirmation') as $interview)
                                        <p class="mt-2 text-sm text-gray-700">
                                            You have been invited for a <span class="font-bold">{{ $interview->title }}</span> interview.
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            Proposed Time: <span class="font-bold">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F jS, Y \a\t h:i A') }}</span>.
                                        </p>
                                        <div class="mt-3 flex items-center space-x-2">
                                            <form method="POST" action="{{ route('applicant.interviews.update', $interview) }}"> 
                                                @csrf
                                                @method('PUT')
                                                <x-primary-button class="bg-ascent-blue hover:bg-blue-700">Confirm Attendance</x-primary-button>
                                            </form>
                                            <a href="{{ route('applicant.interviews.reschedule.show', $interview) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                Request Reschedule
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Communication Log -->
                            @if($application->messages->isNotEmpty())
                                <div class="mt-4 pt-4 border-t">
                                    <h4 class="font-semibold text-sm text-gray-700">Communication History:</h4>
                                    <div class="mt-2 space-y-2">
                                        @foreach($application->messages as $message)
                                            <div class="p-3 bg-gray-50 rounded-lg text-sm">
                                                <p class="text-gray-800">{{ $message->message }}</p>
                                                <p class="text-xs text-right text-gray-500 mt-1">- {{ $message->sender->first_name }} on {{ $message->created_at->format('M d, Y') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Add a message if there are no details to show -->
                            @if($application->interviews->where('status', 'Pending Confirmation')->isEmpty() && $application->messages->isEmpty())
                                <p class="text-sm text-gray-500">No new updates or messages for this application.</p>
                            @endif

                        </div>
                    @empty
                        <p>You have not submitted any applications yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
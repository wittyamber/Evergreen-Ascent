<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Schedule Interview for: {{ $application->user->first_name }} {{ $application->user->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <div class="p-6 text-gray-900">
                    <p class="mb-4">You are scheduling an interview for the position of <span class="font-semibold">{{ $application->jobPosting->title }}</span>.</p>

                    <form method="POST" action="{{ route('hr.interviews.store', $application) }}"> 
                        @csrf
                        <!-- Interview Title -->
                        <div>
                            <x-input-label for="title" value="Interview Title (e.g., Technical Screening)" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="scheduled_at_date" value="Date" />
                            <x-text-input id="scheduled_at_date" class="block mt-1 w-full datepicker" type="text" name="scheduled_at_date" required />
                        </div>

                        <!-- Time -->
                        <div class="mt-4">
                            <x-input-label for="scheduled_at_time" value="Time" />
                            <x-text-input id="scheduled_at_time" class="block mt-1 w-full timepicker" type="text" name="scheduled_at_time" required />
                        </div>

                        <!-- Duration -->
                        <div class="mt-4">
                            <x-input-label for="duration_minutes" value="Duration (in minutes)" />
                            <x-text-input id="duration_minutes" class="block mt-1 w-full" type="number" name="duration_minutes" value="30" required />
                        </div>
                        
                        <!-- Location / URL -->
                        <div class="mt-4">
                            <x-input-label for="location" value="Location (e.g., Google Meet URL or Room Number)" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required />
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-2">
                            <x-secondary-button type="submit" name="action_add_another" value="true">
                                Send & Add Another
                            </x-secondary-button>

                            <x-primary-button class="bg-ascent-blue hover:bg-blue-700">
                                Send & Close
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
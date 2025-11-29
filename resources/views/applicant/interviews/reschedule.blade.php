<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Interview Reschedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    <!-- Info Box -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Current Appointment: 
                                    <span class="font-bold">
                                        {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F j \a\t h:i A') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('applicant.interviews.reschedule.store', $interview) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-input-label for="reason" :value="__('Reason for Rescheduling')" />
                            <p class="text-xs text-gray-500 mb-2">Please provide a brief reason to the hiring manager.</p>
                            <textarea id="reason" name="reason" rows="3" class="block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" required placeholder="e.g. I have a conflict with my current work schedule..."></textarea>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="preferred_time" :value="__('Preferred Alternative Dates/Times')" />
                            <p class="text-xs text-gray-500 mb-2">Suggest 2-3 slots that work better for you.</p>
                            <textarea id="preferred_time" name="preferred_time" rows="3" class="block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" required placeholder="e.g. Monday after 2 PM, or Tuesday morning before 10 AM."></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('applicant.applications.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700">
                                {{ __('Submit Request') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
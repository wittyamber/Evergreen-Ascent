<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request to Reschedule Interview
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-2">You are requesting to reschedule the following interview:</p>
                    <div class="p-4 bg-gray-50 rounded-lg mb-6">
                        <p class="font-bold">{{ $interview->title }}</p>
                        <p>Originally scheduled for: {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F jS, Y \a\t h:i A') }}</p>
                    </div>

                    <form method="POST" action="{{ route('applicant.interviews.reschedule.store', $interview) }}"> 
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="reschedule_reason" value="Reason for Rescheduling (Optional)" />
                            <textarea id="reschedule_reason" name="reschedule_reason" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">Submitting this request will cancel the original time slot and notify the HR team. They will contact you to arrange a new time.</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="bg-ascent-blue hover:bg-blue-700">
                                Submit Reschedule Request
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
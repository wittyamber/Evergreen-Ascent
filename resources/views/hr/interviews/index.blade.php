<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Upcoming Interviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($interviews as $interview)
                        <div class="p-4 @unless($loop->last) border-b @endunless">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-bold text-lg text-ascent-blue">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('l, F jS') }}</p>
                                    <p class="font-semibold">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('h:i A') }} ({{ $interview->duration_minutes }} min)</p>
                                </div>
                                <div>
                                    <p class="font-bold">{{ $interview->application->user->first_name }} {{ $interview->application->user->last_name }}</p>
                                    <p class="text-sm text-gray-600">For: {{ $interview->application->jobPosting->title }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold">{{ $interview->title }}</p>
                                    <a href="{{ route('hr.applications.show', $interview->application) }}" class="text-sm text-ascent-blue hover:underline">
                                        View Application &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>You have no upcoming interviews scheduled.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
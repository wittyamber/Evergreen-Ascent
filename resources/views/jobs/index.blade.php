<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Open Positions at Evergreen Solutions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @forelse ($jobPostings as $job)
                            <div class="p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $job->title }}</h3>
                                    <span class="px-3 py-1 text-xs font-semibold text-white bg-blue-600 rounded-full">{{ $job->type }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">{{ $job->location }}</p>
                                <div class="mt-4 text-sm text-gray-700">
                                    {{ Str::limit($job->description, 150) }}
                                </div>
                                <div class="mt-4 text-right">
                                    <a href="{{ route('jobs.show', $job) }}" class="font-semibold text-indigo-600 hover:underline">
                                        View Details & Apply &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-500">
                                <p>There are currently no open positions. Please check back later!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
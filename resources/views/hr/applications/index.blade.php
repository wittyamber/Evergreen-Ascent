<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Applicants for: {{ $job->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($applications as $application)
                        <div class="flex justify-between items-center p-4 border-b">
                            <div>
                                <h3 class="font-bold">{{ $application->user->first_name }} {{ $application->user->last_name }}</h3>
                                <p class="text-sm text-gray-500">Applied on: {{ $application->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $application->status }}
                                </span>
                            </div>
                            <div>
                                <a href="{{ route('hr.applications.show', $application) }}" class="text-indigo-600 hover:underline">View Application</a>
                            </div>
                        </div>
                    @empty
                        <p>No applications have been submitted for this job yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
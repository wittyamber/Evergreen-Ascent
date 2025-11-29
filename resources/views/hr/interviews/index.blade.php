<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('My Agenda') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Quick Stats Row -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-emerald-100 flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Upcoming Total</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $interviews->count() }}</p>
                    </div>
                </div>
                <!-- You can add more stats here later (e.g. "Today's Interviews") -->
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Upcoming Schedule</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($interviews as $interview)
                        <div class="p-6 hover:bg-gray-50 transition duration-150 group">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                
                                <!-- Time Column -->
                                <div class="flex items-center md:w-1/4">
                                    <div class="flex-shrink-0 text-center mr-4 bg-emerald-50 rounded-lg p-2 border border-emerald-100 min-w-[60px]">
                                        <span class="block text-xs font-bold text-emerald-600 uppercase">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('M') }}</span>
                                        <span class="block text-xl font-extrabold text-gray-900">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('d') }}</span>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($interview->scheduled_at)->format('h:i A') }}</p>
                                        <p class="text-xs text-gray-500 font-medium">{{ $interview->duration_minutes }} mins</p>
                                    </div>
                                </div>

                                <!-- Candidate Column -->
                                <div class="md:w-1/3">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 mr-3">
                                            {{ substr($interview->application->user->first_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 group-hover:text-emerald-600 transition">
                                                {{ $interview->application->user->first_name }} {{ $interview->application->user->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">{{ $interview->title }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Context -->
                                <div class="md:w-1/4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-800">
                                        {{ Str::limit($interview->application->jobPosting->title, 20) }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ Str::limit($interview->location, 20) }}
                                    </p>
                                </div>

                                <!-- Action -->
                                <div class="text-right">
                                    <a href="{{ route('hr.applications.show', $interview->application) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800 flex items-center justify-end">
                                        View Details <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No interviews scheduled</h3>
                            <p class="mt-1 text-sm text-gray-500">Your agenda is clear for now.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
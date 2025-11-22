<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HR Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Add this success message component -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Your Job Postings</h3>
                        <a href="{{ route('hr.jobs.create') }}" class="...">
                            Create New Job
                        </a>
                    </div>

                    <!-- Job Postings List -->
                    <div class="mt-6 space-y-4">
                        @forelse ($jobPostings as $job)
                            <div class="p-4 bg-gray-100 rounded-lg flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold">{{ $job->title }}</h4>
                                    <div class="text-sm text-gray-600 flex items-center space-x-4">
                                        <span>{{ $job->location }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $job->type }}</span>
                                        <span>&bull;</span>
                                        <!-- Status Toggle Form -->
                                        <form action="{{ route('hr.jobs.update', $job) }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- Hidden inputs to submit all required data without changing it -->
                                            <input type="hidden" name="title" value="{{ $job->title }}">
                                            <input type="hidden" name="location" value="{{ $job->location }}">
                                            <input type="hidden" name="type" value="{{ $job->type }}">
                                            <input type="hidden" name="description" value="{{ $job->description }}">

                                            <!-- The actual status toggle -->
                                            <input type="hidden" name="status" value="{{ $job->status === 'Active' ? 'Draft' : 'Active' }}">
                                            <button type="submit" 
                                                    class="px-2 py-1 text-xs font-semibold rounded-full
                                                        {{ $job->status === 'Active' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                                {{ $job->status }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    <!-- We will add Edit/Delete buttons here later -->
                                     <div class="flex items-center space-x-4">
                                        <!-- View Icon Link -->
                                        <a href="{{ route('jobs.show', $job) }}" class="text-gray-500 hover:text-blue-700">
                                            <span class="sr-only">View</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </a>
                                        <!-- Edit Icon Link -->
                                        <a href="{{ route('hr.jobs.edit', $job) }}" class="text-gray-500 hover:text-indigo-700">
                                            <span class="sr-only">Edit</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <!-- Applicants Icon (NEW) -->
                                        <a href="{{ route('hr.jobs.applications.index', $job) }}" class="text-gray-500 hover:text-green-700" title="View Applicants">
                                            <span class="sr-only">Applicants</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                        </a>
                                        <!-- ADD THE DELETE FORM/ICON -->
                                        <form method="POST" action="{{ route('hr.jobs.destroy', $job) }}" onsubmit="return confirm('Are you sure you want to PERMANENTLY DELETE this job and all its applications? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-700" title="Delete Job">
                                                <span class="sr-only">Delete</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 bg-gray-100 rounded-lg text-center">
                                <p>No job postings found yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
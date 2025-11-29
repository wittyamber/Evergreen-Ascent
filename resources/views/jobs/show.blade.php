<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $job->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Job Details Section -->
            <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900">Job Description</h3>
                    <div class="mt-4 text-gray-700 whitespace-pre-wrap">
                        {{ $job->description }}
                    </div>
                </div>
            </div>

            <!-- Application Form & Info Section -->
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                        <h3 class="text-lg font-bold">Job Details</h3>
                        <div class="mt-4 space-y-2">
                            <p><span class="font-semibold">Location:</span> {{ $job->location }}</p>
                            <p><span class="font-semibold">Type:</span> {{ $job->type }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">Apply for this Position</h3>

                        <!-- Display Success/Error Messages -->
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">{{ session('status') }}</div>
                        @elseif (session('error'))
                            <div class="mb-4 font-medium text-sm text-red-600">{{ session('error') }}</div>
                        @endif

                        @guest
                            <p class="text-sm">
                                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:underline">Log in</a> or 
                                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:underline">Register</a> to apply.
                            </p>
                        @endguest

                        @auth
                            @if(auth()->user()->role === 'applicant')
                                @php
                                    $hasApplied = auth()->user()->applications()->where('job_posting_id', $job->id)->exists();
                                @endphp

                                @if($hasApplied)
                                    <p class="text-sm font-medium text-green-600">You applied for this position on {{ auth()->user()->applications()->where('job_posting_id', $job->id)->first()->created_at->format('M d, Y') }}.</p>
                                @else
                                    <form method="POST" action="{{ route('applications.store', $job) }}" enctype="multipart/form-data" class="space-y-6">
                                        @csrf
                                        <!-- Resume Upload-->
                                        <div class="mb-6">
                                            <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">
                                                Upload Resume (Required) <span class="text-red-500">*</span>
                                            </label>
                                            
                                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-emerald-500 transition relative">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600 justify-center">
                                                        <!-- Removed 'sr-only' and special label wrapping. Just a clean input. -->
                                                        <input id="resume" 
                                                            name="resume" 
                                                            type="file" 
                                                            required 
                                                            accept=".pdf,.doc,.docx"
                                                            class="block w-full text-sm text-gray-500
                                                                    file:mr-4 file:py-2 file:px-4
                                                                    file:rounded-full file:border-0
                                                                    file:text-sm file:font-semibold
                                                                    file:bg-emerald-50 file:text-emerald-700
                                                                    hover:file:bg-emerald-100">
                                                    </div>
                                                    <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 2MB</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Cover Letter Upload (New & Optional) -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">
                                                Cover Letter (Optional)
                                            </label>
                                            <p class="text-xs text-gray-500 mb-2">Upload a specific cover letter for this position.</p>
                                            
                                            <input type="file" 
                                                name="cover_letter" 
                                                id="cover_letter"
                                                accept=".pdf,.doc,.docx"
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                        </div>

                                        <div class="flex justify-end">
                                            <button type="submit" class="bg-emerald-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                                Submit Application
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @else
                                <p class="text-sm text-red-600">You cannot apply with an Admin or HR account.</p>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
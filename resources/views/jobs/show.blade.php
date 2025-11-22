<x-app-layout>
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
                                    <form method="POST" action="{{ route('applications.store', $job) }}" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Resume -->
                                        <div>
                                            <x-input-label for="resume" :value="__('Upload Resume (PDF, DOC, DOCX)')" />
                                            <input id="resume" name="resume" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 mt-1" required>
                                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                                        </div>
                                        <!-- Cover Letter -->
                                        <div class="mt-4">
                                            <x-input-label for="cover_letter" :value="__('Cover Letter (Optional)')" />
                                            <textarea name="cover_letter" id="cover_letter" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('cover_letter') }}</textarea>
                                        </div>
                                        <div class="flex items-center justify-end mt-4">
                                            <x-primary-button>
                                                {{ __('Submit Application') }}
                                            </x-primary-button>
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
</x-app-layout>
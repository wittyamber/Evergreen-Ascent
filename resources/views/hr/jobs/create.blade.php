<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Create New Position') }}
            </h2>
            <a href="{{ route('hr.jobs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                
                <!-- Form Header -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <h3 class="text-md font-medium text-gray-900">Job Details</h3>
                    <p class="text-sm text-gray-500">Fill in the information to post a new opening.</p>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('hr.jobs.store') }}">
                        @csrf

                        <!-- Top Row: Title & Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Job Title')" />
                                <x-text-input id="title" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="title" :value="old('title')" required autofocus placeholder="e.g. Senior Backend Developer" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="location" :value="old('location')" required placeholder="e.g. Manila (Hybrid)" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Second Row: Type & Salary (NEW) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Employment Type')" />
                                <select name="type" id="type" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <!-- Salary Range -->
                            <div>
                                <x-input-label for="salary_range" :value="__('Salary Range (Optional)')" />
                                <x-text-input id="salary_range" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="salary_range" :value="old('salary_range')" placeholder="e.g. ₱40,000 - ₱60,000" />
                                <x-input-error :messages="$errors->get('salary_range')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <x-input-label for="description" :value="__('Job Description & Requirements')" />
                            <textarea name="description" id="description" rows="10" 
                                class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm"
                                placeholder="Describe the role, responsibilities, and qualifications..."
                                >{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('hr.jobs.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                                {{ __('Publish Job Posting') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
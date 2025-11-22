<!-- resources/views/hr/jobs/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Edit Job Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('hr.jobs.update', $job) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Job Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $job->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $job->location)" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        
                        <!-- Type -->
                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Job Type')" />
                            <x-custom-select 
                                name="type" 
                                :options="['Full-time', 'Part-time', 'Contract', 'Internship']"
                                :selected="old('type', $job->type)" 
                            />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <x-custom-select 
                                name="status" 
                                :options="['Draft', 'Active', 'Archived']"
                                :selected="old('status', $job->status)" 
                            />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Job Description')" />
                            <textarea name="description" id="description" rows="6" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500rounded-md shadow-sm">{{ old('description', $job->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Job') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
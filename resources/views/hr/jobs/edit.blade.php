<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Edit Posting: ') }} <span class="text-emerald-600">{{ $job->title }}</span>
            </h2>
            <a href="{{ route('hr.jobs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                
                <div class="p-8">
                    <form method="POST" action="{{ route('hr.jobs.update', $job) }}">
                        @csrf
                        @method('PUT')

                        <!-- Top Row: Title & Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="title" :value="__('Job Title')" />
                                <x-text-input id="title" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="title" :value="old('title', $job->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="location" :value="old('location', $job->location)" required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Second Row: Type, Salary, Status -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Employment Type')" />
                                <select name="type" id="type" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                    @foreach(['Full-time', 'Part-time', 'Contract', 'Internship'] as $type)
                                        <option value="{{ $type }}" {{ old('type', $job->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Salary -->
                            <div>
                                <x-input-label for="salary_range" :value="__('Salary Range')" />
                                <x-text-input id="salary_range" class="block mt-1 w-full focus:ring-emerald-500 focus:border-emerald-500" type="text" name="salary_range" :value="old('salary_range', $job->salary_range)" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Posting Status')" />
                                <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                    <option value="Active" {{ $job->status == 'Active' ? 'selected' : '' }}>🟢 Active (Public)</option>
                                    <option value="Draft" {{ $job->status == 'Draft' ? 'selected' : '' }}>⚪ Draft (Hidden)</option>
                                    <option value="Archived" {{ $job->status == 'Archived' ? 'selected' : '' }}>🔴 Archived</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <x-input-label for="description" :value="__('Job Description')" />
                            <textarea name="description" id="description" rows="10" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">{{ old('description', $job->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('hr.jobs.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                                {{ __('Update Posting') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
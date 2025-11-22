<x-admin-layout>
    @section('header', 'System Configuration')

    <div class="max-w-4xl mx-auto">
        
        <!-- Settings Form -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                
                <!-- Section 1: Branding -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Branding & Identity</h3>
                    <p class="mt-1 text-sm text-gray-500">Customize how the portal looks to applicants and HR.</p>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        
                        <!-- App Name -->
                        <div class="sm:col-span-4">
                            <label for="site_name" class="block text-sm font-medium text-gray-700">Application Name</label>
                            <div class="mt-1">
                                <input type="text" name="site_name" id="site_name" 
                                    value="{{ $settings['site_name'] ?? 'Evergreen Ascent' }}"
                                    class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Current Logo Display -->
                        <div class="sm:col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Current Logo</label>
                            <div class="mt-2 flex items-center">
                                @if(isset($settings['site_logo']) && $settings['site_logo'])
                                    <!-- This combines your URL + /storage/ + the path from DB -->
                                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-16 w-auto p-1 border rounded bg-gray-50">
                                @else
                                    <span class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs">No Logo</span>
                                @endif
                                <div class="ml-4">
                                    <label for="site_logo" class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Upload a new file</span>
                                        <input id="site_logo" name="site_logo" type="file" class="sr-only">
                                    </label>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Contact Info (Example) -->
                <div class="p-6 bg-gray-50">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Information</h3>
                    <p class="mt-1 text-sm text-gray-500">This will appear in email footers.</p>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">Support Email</label>
                            <input type="email" name="contact_email" id="contact_email" 
                                value="{{ $settings['contact_email'] ?? '' }}"
                                class="mt-1 shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="px-4 py-3 bg-gray-100 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Save Configuration
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
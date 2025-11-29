<x-public-layout>
    
    <!-- HERO CAROUSEL -->
    <div x-data="{ activeSlide: 1, totalSlides: 3 }" 
         x-init="setInterval(() => { activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1 }, 6000)" 
         class="relative w-full h-[600px] overflow-hidden bg-gray-900">

        <!-- Slide 1 -->
        <div x-show="activeSlide === 1"
             x-transition:enter="transition transform duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition transform duration-1000"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-100"
             class="absolute inset-0 bg-cover bg-center" 
             style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80');">
             <div class="absolute inset-0 bg-black/50"></div>
        </div>
        
        <!-- Slide 2 -->
        <div x-show="activeSlide === 2"
             x-transition:enter="transition transform duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition transform duration-1000"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-100"
             class="absolute inset-0 bg-cover bg-center" 
             style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1600&q=80');">
             <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Slide 3 -->
        <div x-show="activeSlide === 3"
             x-transition:enter="transition transform duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition transform duration-1000"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-100"
             class="absolute inset-0 bg-cover bg-center" 
             style="background-image: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1600&q=80');">
             <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Text Overlay (Static on top of slides) -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 drop-shadow-lg tracking-tight">
                Welcome to {{ \App\Models\SystemSetting::get('site_name', 'Evergreen') }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl drop-shadow-md">
                Innovating the future through sustainable technology and world-class talent.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('jobs.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
                    View Openings
                </a>
                <a href="{{ route('about') }}" class="bg-white hover:bg-gray-100 text-emerald-900 font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
                    Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- INTRODUCTION SECTION -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Why Join Us?</h2>
            <p class="mt-4 text-lg text-gray-500 max-w-3xl mx-auto">
                We believe in building a workplace where innovation meets sustainability. Our systems are designed to help you grow.
            </p>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Fast-Tracked Growth</h3>
                    <p class="text-gray-500">Our dynamic career paths ensure you never stop learning.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">People First</h3>
                    <p class="text-gray-500">We prioritize the well-being and development of our team.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Modern Systems</h3>
                    <p class="text-gray-500">Powered by "Evergreen Ascent" MIS for seamless management.</p>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
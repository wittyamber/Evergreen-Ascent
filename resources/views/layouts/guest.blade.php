@props(['formSide' => 'left'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Evergreen Ascent') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:flex-row">
            
            <!-- Visual Column (Slideshow with External URLs) -->
            <div class="w-full sm:w-1/2 min-h-[40vh] sm:min-h-screen relative overflow-hidden {{ $formSide === 'right' ? 'sm:order-first' : 'sm:order-last' }}">
                <div x-data="{ activeSlide: 1, totalSlides: 3 }" x-init="setInterval(() => { activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1 }, 5000)" class="relative w-full h-full">
                    
                    <!-- Slide 1: Modern Office (Tech) -->
                    <div x-show="activeSlide === 1" 
                        x-transition:enter="transition opacity duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition opacity duration-1000"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 w-full h-full">
                        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1920&q=80" 
                             alt="Modern Office" 
                             class="w-full h-full object-cover">
                    </div>
                        
                    <!-- Slide 2: Nature/Growth (Green) -->
                    <div x-show="activeSlide === 2" 
                        x-transition:enter="transition opacity duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition opacity duration-1000"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 w-full h-full">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1920&q=80" 
                             alt="Nature and Growth" 
                             class="w-full h-full object-cover">
                    </div>
                        
                    <!-- Slide 3: Skyscrapers (Ascent) -->
                    <div x-show="activeSlide === 3" 
                        x-transition:enter="transition opacity duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition opacity duration-1000"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 w-full h-full">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80" 
                             alt="Skyscrapers" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Dark Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 to-transparent"></div>

                    <!-- Text Overlay -->
                    <div class="absolute bottom-6 left-6 sm:bottom-10 sm:left-10 text-white z-10">
                        <h2 class="text-2xl sm:text-3xl font-bold">Evergreen Ascent</h2>
                        <p class="text-emerald-100 mt-2 text-sm sm:text-base">Elevating Careers, Sustainably.</p>
                    </div>
                </div>
            </div>

            <!-- Form Column -->
            <div class="w-full sm:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50">
                <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl rounded-lg border-t-4 border-emerald-500">
                    
                    <!-- Logo for Mobile (Visible only on small screens) -->
                    <div class="sm:hidden mb-6 text-center">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
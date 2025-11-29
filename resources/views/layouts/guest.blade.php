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
        <div class="min-h-screen flex flex-col sm:flex-row items-center justify-center bg-gray-50">
            
            <!-- Visual Column (Slideshow) -->
            <div class="w-full sm:w-1/2 h-64 sm:h-screen relative overflow-hidden {{ $formSide === 'right' ? 'sm:order-first' : 'sm:order-last' }}">
                <div x-data="{ activeSlide: 1, totalSlides: 3 }" x-init="setInterval(() => { activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1 }, 5000)" class="relative h-full">
                    <!-- Images with Fading Transition -->
                    <div x-show="activeSlide === 1" 
                        x-transition:opacity.duration.1500ms 
                        class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/bg-1.jpg');"></div>
                        
                    <div x-show="activeSlide === 2" 
                        x-transition:opacity.duration.1500ms 
                        class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/bg-2.jpg');"></div>
                        
                    <div x-show="activeSlide === 3" 
                        x-transition:opacity.duration.1500ms 
                        class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/bg-3.jpg');"></div>
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
            </div>

            <!-- Form Column -->
            <div class="w-full sm:w-1/2 flex items-center justify-center p-6 sm:p-12">
                <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl rounded-lg">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
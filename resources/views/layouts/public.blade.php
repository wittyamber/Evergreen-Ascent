<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SystemSetting::get('site_name', 'Evergreen Ascent') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">
    
    <!-- PUBLIC NAVIGATION BAR -->
    <nav x-data="{ open: false }" class="bg-evergreen border-b border-emerald-700 bg-emerald-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <!-- 1. Logo & Public Menu -->
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <!-- Reusing your Logo Component -->
                            <x-application-logo 
                                :showText="true" 
                                imgClass="h-9 w-auto" 
                                textClass="ml-3 text-xl font-bold text-white tracking-tight" />
                        </a>
                    </div>

                    <!-- Public Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-white text-white' : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('about') ? 'border-white text-white' : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            About Us
                        </a>
                        <a href="{{ route('services') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('services') ? 'border-white text-white' : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            Services
                        </a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('jobs.index') ? 'border-white text-white' : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            Careers
                        </a>
                        <a href="{{ route('system') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('system') ? 'border-white text-white' : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            The System
                        </a>
                    </div>
                </div>

                <!-- 2. Auth Buttons (Right Side) -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-white font-semibold hover:text-emerald-200">Go to Dashboard &rarr;</a>
                    @else
                        <a href="{{ route('login') }}" class="text-emerald-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="ml-4 bg-white text-emerald-800 hover:bg-gray-100 px-4 py-2 rounded-md text-sm font-bold shadow transition">Register</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-200 hover:text-white hover:bg-emerald-700 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-emerald-900">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-emerald-100 hover:text-white hover:bg-emerald-800 hover:border-emerald-300 transition duration-150 ease-in-out">Home</a>
                <a href="{{ route('jobs.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-emerald-100 hover:text-white hover:bg-emerald-800 hover:border-emerald-300 transition duration-150 ease-in-out">Careers</a>
                @guest
                    <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-white font-bold">Log In</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <x-application-logo :showText="true" imgClass="h-8 w-auto" textClass="ml-3 text-lg font-bold text-white" />
                <p class="mt-4 text-gray-400 text-sm">Empowering the future workforce with sustainable growth and innovation.</p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white">Services</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="hover:text-white">Careers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Connect</h4>
                <p class="text-gray-400 text-sm">Philippines<br>contact@evergreen.com</p>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} {{ \App\Models\SystemSetting::get('site_name') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
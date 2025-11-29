<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Evergreen Ascent') }} - Admin</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        
        <!-- 1. Sidebar (The "Stone" Foundation) -->
        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col shadow-xl z-20">
            <!-- Brand Logo Area -->
            <div class="h-16 flex items-center px-6 bg-slate-950 border-b border-slate-800">
                <div class="flex items-center gap-2 text-emerald-500 font-bold text-xl">
                    <!-- Simple Icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    <span>Admin Panel</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- User Management -->
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    HR Users
                </a>

                <!-- Audit Logs (NEW - Was missing in sidebar) -->
                <a href="{{ route('admin.audit.logs') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('admin.audit.logs') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Audit Logs
                </a>

                <!-- System Settings -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Configuration
                </a>

            </nav>

            <!-- User Profile / Logout -->
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-900 text-emerald-300 flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <!-- Fixed: Use first_name + last_name instead of name -->
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p class="text-xs text-slate-500">Super Admin</p>
                        
                        <!-- Logout Button (Tiny Text Link) -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="text-xs text-red-400 hover:text-red-300 hover:underline">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- 2. Main Content Area -->
        <main class="flex-1 overflow-y-auto h-screen">
            <!-- Top Header (Mobile / Breadcrumbs) -->
            <header class="bg-white shadow-sm h-16 flex items-center px-8 justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @yield('header')
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-400">{{ now()->format('l, F j, Y') }}</span>
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-emerald-600 flex items-center gap-1">
                        View Public Site &rarr;
                    </a>
                </div>
            </header>

            <!-- SUCCESS MESSAGE ALERT -->
            @if (session('success'))
                <div class="max-w-7xl mx-auto mt-6 px-8">
                    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm flex justify-between items-center" role="alert">
                        <div>
                            <p class="font-bold">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                        <span class="text-2xl cursor-pointer hover:text-emerald-900" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
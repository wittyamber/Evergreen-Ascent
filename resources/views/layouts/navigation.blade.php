<nav x-data="{ open: false }" class="bg-emerald-800 border-b border-emerald-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo 
                            :showText="true" 
                            imgClass="h-9 w-auto" 
                            textClass="ml-3 text-xl font-bold text-white tracking-tight" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <!-- 1. DASHBOARD -->
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                       {{ request()->routeIs('dashboard') || request()->routeIs('hr.dashboard') 
                          ? 'border-white text-white' 
                          : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                        {{ __('Dashboard') }}
                    </a>

                    <!-- HR & ADMIN LINKS -->
                    @if(in_array(auth()->user()->role, ['hr', 'admin']))
                        
                        <!-- 2. MY AGENDA -->
                        <a href="{{ route('hr.interviews.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                           {{ request()->routeIs('hr.interviews.index') 
                              ? 'border-white text-white' 
                              : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                            {{ __('My Agenda') }}
                        </a>

                        <!-- 3. POSTED JOBS -->
                        <a href="{{ route('hr.jobs.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                           {{ request()->routeIs('hr.jobs.index') 
                              ? 'border-white text-white' 
                              : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                            {{ __('Posted Jobs') }}
                        </a>

                    @endif

                    <!-- APPLICANT LINKS -->
                    @if(auth()->user()->role === 'applicant')
                        <!-- 1. Dashboard -->
                        <!-- <a href="{{ route('dashboard') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                        {{ request()->routeIs('dashboard') 
                            ? 'border-white text-white' 
                            : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                            {{ __('Dashboard') }}
                        </a> -->

                        <!-- 2. Browse Jobs -->
                        <a href="{{ route('jobs.index') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                        {{ request()->routeIs('jobs.index') 
                            ? 'border-white text-white' 
                            : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                            {{ __('Browse Jobs') }}
                        </a>

                        <!-- 3. My Applications -->
                        <a href="{{ route('applicant.applications.index') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out 
                        {{ request()->routeIs('applicant.applications.index') 
                            ? 'border-white text-white' 
                            : 'border-transparent text-emerald-200 hover:text-white hover:border-emerald-300' }}">
                            {{ __('My Applications') }}
                        </a>
                        
                        <!-- 4. Messages (Redirects to Applications for context, or a dedicated inbox if you built one) -->
                        <!-- For now, we link this to applications because messages are usually attached to a specific job app -->
                        <a href="{{ route('applicant.applications.index') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out border-transparent text-emerald-200 hover:text-white hover:border-emerald-300">
                            {{ __('Messages') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-emerald-100 hover:text-white hover:bg-emerald-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->first_name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-200 hover:text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-emerald-900 border-t border-emerald-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-emerald-100 hover:bg-emerald-800 hover:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- Add other mobile links here if needed, styled similarly -->
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-emerald-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-emerald-100 hover:bg-emerald-800 hover:text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-emerald-100 hover:bg-emerald-800 hover:text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
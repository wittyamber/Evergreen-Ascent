<x-public-layout>

    <!-- 1. HERO HEADER (Enhanced with Animated Elements) -->
    <div class="relative bg-slate-950 py-32 sm:py-48 overflow-hidden">
        <!-- Animated Grid Pattern Background -->
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        <div class="absolute inset-0 opacity-10" 
             style="background-image: linear-gradient(#10b981 1px, transparent 1px), linear-gradient(to right, #10b981 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        
        <!-- Floating Orbs -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center z-10">
            <!-- Status Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-900/30 border border-emerald-500/30 text-emerald-400 text-sm font-mono mb-8 backdrop-blur-sm hover:bg-emerald-900/40 transition">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                System Status: Operational
            </div>
            
            <!-- Hero Title with Stagger Animation -->
            <h1 class="text-5xl font-extrabold text-white sm:text-7xl tracking-tight mb-6 leading-tight">
                Project <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-400 bg-[length:200%_auto] animate-gradient">Evergreen Ascent</span>
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-slate-400 leading-relaxed font-light mb-10">
                The definitive platform for managing the company's end-to-end talent acquisition lifecycle.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
                <a href="#overview" class="group relative px-8 py-4 bg-emerald-500 text-white font-semibold rounded-xl overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/50">
                    <span class="relative z-10">Explore Features</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
                <a href="#tech" class="px-8 py-4 bg-slate-800 text-slate-200 font-semibold rounded-xl border border-slate-700 hover:bg-slate-700 hover:border-emerald-500/50 transition-all hover:scale-105">
                    View Architecture
                </a>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="mt-16 animate-bounce">
                <svg class="w-6 h-6 mx-auto text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. SYSTEM OVERVIEW (Enhanced with Better Visuals) -->
    <div id="overview" class="py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-center">
                
                <!-- Text Content -->
                <div class="order-2 lg:order-1">
                    <h2 class="text-base text-emerald-600 font-bold tracking-wide uppercase mb-3">The Architecture</h2>
                    <h3 class="text-3xl font-extrabold text-gray-900 sm:text-5xl mb-6 leading-tight">
                        More than just software.<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">It's a strategic advantage.</span>
                    </h3>
                    <div class="space-y-6 text-gray-600 leading-relaxed">
                        <p class="text-lg">
                            Evergreen Ascent is the official <strong class="text-gray-900">Applicant Scheduling and Management Information System (MIS)</strong> for Evergreen Solutions. It is engineered to transform the recruitment process from a logistical challenge into a seamless workflow.
                        </p>
                        <p class="text-lg">
                            The system is designed to provide a transparent and engaging experience for applicants, while equipping the Human Resources team with powerful tools for automation and data-driven decision-making. Evergreen Ascent is the first step in a candidate's journey of growth with the company.
                        </p>
                        
                        <!-- Stats Row -->
                        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200 mt-8">
                            <div>
                                <div class="text-3xl font-bold text-emerald-600">99.9%</div>
                                <div class="text-sm text-gray-500 mt-1">Uptime</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-emerald-600">24/7</div>
                                <div class="text-sm text-gray-500 mt-1">Access</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-emerald-600">100%</div>
                                <div class="text-sm text-gray-500 mt-1">Secure</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Visual with Multiple Layers -->
                <div class="relative order-1 lg:order-2">
                    <!-- Background Blobs -->
                    <div class="absolute -top-10 -right-10 w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
                    
                    <!-- Main Dashboard Card -->
                    <div class="relative rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 border border-slate-700 shadow-2xl p-2 transform hover:rotate-0 rotate-1 transition-all duration-500 hover:scale-105">
                        <div class="rounded-xl overflow-hidden relative">
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900/60"></div>
                            <img src="https://images.unsplash.com/photo-1551033406-611cf9a28f67?auto=format&fit=crop&w=800&q=80" alt="System Dashboard" class="w-full h-auto">
                            
                            <!-- Window Controls -->
                            <div class="absolute top-4 left-4 flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500 hover:bg-red-600 cursor-pointer transition"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500 hover:bg-yellow-600 cursor-pointer transition"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500 hover:bg-green-600 cursor-pointer transition"></div>
                            </div>
                            
                            <!-- Floating Badge -->
                            <div class="absolute bottom-4 right-4 px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg shadow-lg">
                                <div class="text-xs font-semibold text-emerald-600">Live Dashboard</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Card 1 -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-xl p-4 border border-gray-100 hover:scale-110 transition-transform duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Active Users</div>
                                <div class="text-lg font-bold text-gray-900">1,247</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Card 2 -->
                    <div class="absolute -top-6 -right-6 bg-white rounded-xl shadow-xl p-4 border border-gray-100 hover:scale-110 transition-transform duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Efficiency</div>
                                <div class="text-lg font-bold text-gray-900">+58%</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 3. OBJECTIVES & VALUE PROP (Enhanced Cards with Hover Effects) -->
    <div class="bg-gradient-to-b from-slate-50 to-white py-32 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-6">
                    Core Objectives
                </div>
                <h2 class="text-4xl font-extrabold text-slate-900 sm:text-5xl mb-4 leading-tight">
                    Built to deliver value to<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">everyone involved</span>
                </h2>
                <p class="text-xl text-slate-500">
                    Three pillars of excellence for Applicants, HR, and Administrators.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Objective 1: Candidate -->
                <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 overflow-hidden">
                    <!-- Animated Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-emerald-500 to-emerald-600 group-hover:w-full group-hover:opacity-5 transition-all duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="h-16 w-16 bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg group-hover:shadow-emerald-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-emerald-600 transition-colors">
                            Elevate the Candidate Journey
                        </h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            To offer every applicant a clear, professional, and self-service portal to track their application's progress and schedule interviews with ease.
                        </p>
                        <div class="flex items-center text-emerald-600 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                            Learn more
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Objective 2: HR -->
                <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-blue-600 group-hover:w-full group-hover:opacity-5 transition-all duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="h-16 w-16 bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg group-hover:shadow-blue-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">
                            Streamline HR Operations
                        </h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            To provide the Talent Acquisition team with a unified dashboard to manage pipelines, automate scheduling, and focus on high-value strategic tasks.
                        </p>
                        <div class="flex items-center text-blue-600 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                            Learn more
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Objective 3: Security -->
                <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-purple-500 to-purple-600 group-hover:w-full group-hover:opacity-5 transition-all duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="h-16 w-16 bg-gradient-to-br from-purple-100 to-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg group-hover:shadow-purple-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-purple-600 transition-colors">
                            Guarantee Security
                        </h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            To deliver a secure administrative console for managing roles and ensuring the confidentiality and integrity of all candidate data.
                        </p>
                        <div class="flex items-center text-purple-600 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                            Learn more
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. TECH STACK (Enhanced with Icons and Animations) -->
    <div id="tech" class="relative bg-slate-900 py-32 border-t border-slate-800 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-block px-4 py-2 bg-slate-800 border border-slate-700 text-emerald-400 rounded-full text-sm font-mono mb-8">
                Technology Stack
            </div>
            <h2 class="text-4xl font-extrabold text-white mb-6">
                Powered By Modern Architecture
            </h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-16">
                Built with industry-leading technologies for performance, scalability, and developer experience.
            </p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                <!-- Laravel -->
                <div class="group relative bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8 hover:bg-slate-800 hover:border-emerald-500/50 hover:scale-110 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    <div class="relative">
                        <div class="text-5xl mb-4">🚀</div>
                        <span class="text-2xl font-extrabold text-white block mb-2">Laravel 11</span>
                        <span class="text-xs text-slate-500 uppercase tracking-wider">Core Framework</span>
                    </div>
                </div>
                
                <!-- Tailwind -->
                <div class="group relative bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8 hover:bg-slate-800 hover:border-teal-500/50 hover:scale-110 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    <div class="relative">
                        <div class="text-5xl mb-4">🎨</div>
                        <span class="text-2xl font-extrabold text-teal-400 block mb-2">Tailwind</span>
                        <span class="text-xs text-slate-500 uppercase tracking-wider">UI Engine</span>
                    </div>
                </div>
                
                <!-- MySQL -->
                <div class="group relative bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8 hover:bg-slate-800 hover:border-blue-500/50 hover:scale-110 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    <div class="relative">
                        <div class="text-5xl mb-4">🗄️</div>
                        <span class="text-2xl font-extrabold text-blue-400 block mb-2">MySQL</span>
                        <span class="text-xs text-slate-500 uppercase tracking-wider">Data Integrity</span>
                    </div>
                </div>
                
                <!-- Alpine -->
                <div class="group relative bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8 hover:bg-slate-800 hover:border-yellow-500/50 hover:scale-110 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-transparent opacity-0 group-hover:opacity-100 rounded-2xl transition-opacity"></div>
                    <div class="relative">
                        <div class="text-5xl mb-4">⚡</div>
                        <span class="text-2xl font-extrabold text-yellow-400 block mb-2">Alpine.js</span>
                        <span class="text-xs text-slate-500 uppercase tracking-wider">Interactivity</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. CTA Section (New) -->
    <div class="bg-gradient-to-br from-emerald-600 to-teal-600 py-24">
        <div class="max-w-4xl mx-auto text-center px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-white mb-6">
                Ready to Transform Your Hiring Process?
            </h2>
            <p class="text-xl text-emerald-100 mb-10 leading-relaxed">
                Join Evergreen Solutions in revolutionizing talent acquisition with cutting-edge technology.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="group px-8 py-4 bg-white text-emerald-600 font-bold rounded-xl hover:bg-emerald-50 transition-all hover:scale-105 shadow-xl hover:shadow-2xl">
                    Get Started
                    <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="#" class="px-8 py-4 border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition-all hover:scale-105">
                    View Documentation
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes gradient {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        
        .animate-gradient {
            animation: gradient 3s ease infinite;
        }
    </style>

</x-public-layout>
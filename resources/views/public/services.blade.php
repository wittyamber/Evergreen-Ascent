<x-public-layout>

    <!-- 1. HERO HEADER (Deep & Spacious) -->
    <div class="relative bg-slate-900 py-40 sm:py-48 overflow-hidden">
        <!-- Abstract Tech Background -->
        <div class="absolute inset-0 opacity-20" 
             style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <!-- Gradient Fade -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-emerald-900/50 border border-emerald-500/30 text-emerald-400 text-sm font-semibold tracking-wide uppercase mb-6">
                What We Deliver
            </span>
            <h1 class="text-5xl font-extrabold text-white sm:text-7xl tracking-tight mb-8">
                Sustainable Solutions<br>for a Digital World
            </h1>
            <p class="max-w-3xl mx-auto text-xl text-slate-300 font-light leading-relaxed">
                Empowering industries to achieve peak efficiency through AI-driven intelligence and renewable integration.
            </p>
        </div>
    </div>

    <!-- 2. MAIN SERVICES (Zig-Zag Layout with Massive Spacing) -->
    <div class="py-32 bg-white overflow-hidden">
        
        <!-- Service 1: AI Resource Management -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-32 lg:mb-48"> <!-- Added huge bottom margin -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-center"> <!-- Increased Gap -->
                
                <!-- Text (Left) -->
                <div class="order-2 lg:order-1">
                    <div class="h-16 w-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-8 border border-emerald-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">AI-Driven Resource Management</h2>
                    <p class="text-xl text-gray-500 leading-relaxed mb-8">
                        Optimize your consumption patterns with our proprietary machine learning algorithms. We analyze real-time data to predict demand, reduce waste, and automate resource allocation across complex supply chains.
                    </p>
                    <ul class="space-y-5 text-gray-600 text-lg">
                        <li class="flex items-center"><svg class="w-6 h-6 text-emerald-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Predictive Maintenance</li>
                        <li class="flex items-center"><svg class="w-6 h-6 text-emerald-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Smart Grid Integration</li>
                        <li class="flex items-center"><svg class="w-6 h-6 text-emerald-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Automated Supply Chain Logic</li>
                    </ul>
                </div>

                <!-- Image (Right) -->
                <div class="mt-12 lg:mt-0 order-1 lg:order-2 relative">
                    <!-- Decorative Element behind -->
                    <div class="absolute -right-4 -top-4 w-full h-full bg-emerald-100 rounded-3xl transform rotate-3"></div>
                    
                    <div class="relative rounded-3xl shadow-2xl overflow-hidden group border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Data Analytics" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-out">
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 2: Renewable Strategy (Reversed Layout) -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-32 lg:mb-48">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-center">
                <!-- Image (Left) -->
                <div class="relative">
                    <!-- Decorative Element behind -->
                    <div class="absolute -left-4 -bottom-4 w-full h-full bg-blue-100 rounded-3xl transform -rotate-3"></div>

                    <div class="relative rounded-3xl shadow-2xl overflow-hidden group border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=800&q=80" alt="Renewable Energy" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-out">
                    </div>
                </div>

                <!-- Text (Right) -->
                <div>
                    <div class="h-16 w-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8 border border-blue-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">Renewable Energy Strategy</h2>
                    <p class="text-xl text-gray-500 leading-relaxed mb-8">
                        Transitioning to green energy shouldn't disrupt your business. We design seamless integration frameworks that allow enterprises to adopt solar, wind, and hydro power while maintaining 99.99% operational uptime.
                    </p>
                    <ul class="space-y-5 text-gray-600 text-lg">
                        <li class="flex items-center"><svg class="w-6 h-6 text-blue-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Carbon Footprint Auditing</li>
                        <li class="flex items-center"><svg class="w-6 h-6 text-blue-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Infrastructure Transition Planning</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Service 3: Enterprise Consulting -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-center">
                <!-- Text (Left) -->
                <div class="order-2 lg:order-1">
                    <div class="h-16 w-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-8 border border-purple-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">Enterprise Consulting</h2>
                    <p class="text-xl text-gray-500 leading-relaxed mb-8">
                        Technology is only as good as the strategy behind it. Our team of world-class engineers and environmental scientists partner with your leadership to build a roadmap for the next decade of growth.
                    </p>
                    <a href="{{ route('about') }}" class="inline-flex items-center text-lg font-semibold text-purple-600 hover:text-purple-800 transition">
                        Meet our experts <span class="ml-2 text-2xl">&rarr;</span>
                    </a>
                </div>
                
                <!-- Image (Right) -->
                <div class="mt-12 lg:mt-0 order-1 lg:order-2 relative">
                    <!-- Decorative Element behind -->
                    <div class="absolute -right-4 -bottom-4 w-full h-full bg-purple-100 rounded-3xl transform rotate-2"></div>

                    <div class="relative rounded-3xl shadow-2xl overflow-hidden group border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" alt="Consulting Team" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-out">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. FEATURE GRID (Improved Spacing) -->
    <!-- I increased padding-top (py-40) and added padding-bottom (pb-40) to separate it from the dark section -->
    <div class="bg-gray-50 py-32 sm:py-40 pb-48 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase mb-3">Why Industry Leaders Choose Evergreen</h2>
            <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-20">Built for Scale, Designed for Impact</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Card 1 -->
                <div class="bg-white p-10 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="h-12 w-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Scalability First</h3>
                    <p class="text-gray-500 leading-relaxed">Our systems are designed to handle global-scale data loads without compromising speed or reliability.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white p-10 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bank-Grade Security</h3>
                    <p class="text-gray-500 leading-relaxed">We employ AES-256 encryption and multi-layer RBAC to protect your most proprietary data.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white p-10 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Compliance Ready</h3>
                    <p class="text-gray-500 leading-relaxed">Fully compliant with ISO 14001 environmental standards and GDPR data regulations.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. CTA (Fixed Spacing & Contrast) -->
    <!-- Added -mt-24 to pull it up slightly into the previous section's whitespace, giving a layered effect, 
         but kept enough padding inside so text breathes. -->
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 -mt-24 mb-24 z-10">
        <div class="bg-slate-900 rounded-3xl shadow-2xl overflow-hidden">
            <div class="px-6 py-16 sm:px-12 sm:py-20 text-center relative">
                <!-- Background decoration -->
                <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
                
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6 relative z-10">
                    Need a custom solution?
                </h2>
                <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto leading-relaxed relative z-10">
                    We are always looking for new challenges. If you have a project that needs the Evergreen touch, let's connect and build something sustainable.
                </p>
                <div class="relative z-10">
                    <a href="mailto:contact@evergreen.com" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold rounded-full text-slate-900 bg-emerald-400 hover:bg-emerald-300 transition duration-300 shadow-lg hover:shadow-emerald-500/50">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-public-layout>
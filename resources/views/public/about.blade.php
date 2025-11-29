<x-public-layout>
    
    <!-- 1. HERO HEADER -->
    <div class="relative bg-emerald-900 py-24 sm:py-32 overflow-hidden">
        <!-- Background decorative pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl tracking-tight">
                Pioneering the Future
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
                Where cutting-edge technology meets ecological responsibility.
            </p>
        </div>
    </div>

     <!-- 2. COMPANY STORY SECTION (Relaxed Grid & Typography)  -->
    <div class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left: Text Content -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase">Who We Are</h2>
                        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            About Evergreen Solutions
                        </p>
                    </div>
                    
                    <div class="prose prose-lg text-gray-500 leading-relaxed text-justify">
                        <p>
                            Evergreen Solutions is a world-renowned leader in the sustainable technology sector, dedicated to developing enduring solutions for global environmental challenges. By integrating cutting-edge AI with breakthroughs in renewable energy and resource management, we provide robust platforms that empower industries to achieve peak operational efficiency while fostering ecological responsibility.
                        </p>
                    </div>

                    <!-- The Quote Box -->
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-6 rounded-r-lg">
                        <p class="text-lg font-medium text-emerald-900 italic">
                            "Our mission is to build a sustainable future on a foundation of lasting innovation and unwavering reliability."
                        </p>
                    </div>

                    <div class="prose prose-lg text-gray-500 leading-relaxed text-justify">
                        <p>
                            This commitment to long-term value has established us as a trusted partner for global enterprises and a premier destination for the most sought-after talent in science, engineering, and technology.
                        </p>
                    </div>
                </div>

                <!-- Right: Image/Visual (Better framing) -->
                <div class="relative mt-12 lg:mt-0">
                    <!-- Background blobs for depth -->
                    <div class="absolute -top-4 -right-4 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
                    <div class="absolute -bottom-8 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animation-delay-2000"></div>
                    
                    <div class="relative rounded-2xl shadow-2xl overflow-hidden border-4 border-white transform hover:scale-[1.02] transition duration-500">
                        <img class="w-full h-full object-cover" 
                             src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80" 
                             alt="Green Technology Innovation">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. OUR VALUES (Derived from your text) -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Driven by Core Values</h2>
                <p class="mt-2 text-lg text-gray-500">Upholding a candidate experience reflecting stability and growth.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-emerald-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Innovation</h3>
                    <p class="mt-2 text-gray-600">Integrating AI and renewable breakthroughs to solve global challenges.</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-blue-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Reliability</h3>
                    <p class="mt-2 text-gray-600">Providing robust platforms and creating a foundation of long-term value.</p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-purple-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Human-Centric</h3>
                    <p class="mt-2 text-gray-600">Fostering professional growth and prioritizing the people behind the tech.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. CTA SECTION (Larger & Centered) -->
    <div class="bg-emerald-900 relative overflow-hidden">
         <!-- Abstract decoration -->
         <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
         
        <div class="max-w-4xl mx-auto py-20 px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6">
                Ready to make an impact?
            </h2>
            <p class="text-xl text-emerald-100 mb-10 max-w-2xl mx-auto">
                Join our growing team today and help us build a sustainable tomorrow.
            </p>
            
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-emerald-900 bg-white hover:bg-gray-100 shadow-lg transform transition hover:scale-105">
                View Open Positions
            </a>
        </div>
    </div>

</x-public-layout>
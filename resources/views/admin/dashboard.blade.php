<x-admin-layout>
    @section('header', 'Admin Dashboard')

    <!-- Welcome Section -->
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-900">System Overview</h3>
        <p class="text-gray-500">Real-time metrics for {{ config('app.name', 'Evergreen Ascent') }}.</p>
    </div>

    <!-- 1. Key Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- System Health -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-emerald-500 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">System Status</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    <span class="text-xl font-bold text-gray-900">Operational</span>
                </div>
            </div>
            <div class="p-3 bg-emerald-50 rounded-full text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- HR Users -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-slate-700 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">HR Accounts</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['hr_count'] ?? 0 }}</p>
            </div>
            <div class="p-3 bg-slate-100 rounded-full text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Total Applicants (If you passed this data, otherwise generic users) -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Applicants</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['applicant_count'] ?? 0 }}</p>
            </div>
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>

        <!-- Audit Logs -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-purple-500 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Logged Events</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['log_count'] ?? 0 }}</p>
            </div>
            <div class="p-3 bg-purple-50 rounded-full text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
        </div>
    </div>

    <!-- 2. Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Quick Actions Panel -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
            <h4 class="font-bold text-gray-900 mb-4">Quick Configuration</h4>
            <div class="space-y-4">
                <a href="{{ route('admin.users.create') }}" class="block p-4 rounded-lg bg-gray-50 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-200 transition group">
                    <div class="flex items-center">
                        <div class="p-2 bg-white rounded-md shadow-sm text-emerald-600 group-hover:text-emerald-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900 group-hover:text-emerald-900">Add New HR User</p>
                            <p class="text-xs text-gray-500">Grant access to a new recruiter.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="block p-4 rounded-lg bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 transition group">
                    <div class="flex items-center">
                        <div class="p-2 bg-white rounded-md shadow-sm text-blue-600 group-hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900 group-hover:text-blue-900">System Configuration</p>
                            <p class="text-xs text-gray-500">Update branding and site settings.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- System Tips / Health -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 shadow-sm rounded-xl border border-slate-700 p-6 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-bold text-lg mb-2">Admin Security Tip</h4>
                <p class="text-slate-300 text-sm leading-relaxed mb-4">
                    Regularly review the <strong>Audit Logs</strong> to ensure no unauthorized changes have been made to user roles or system settings.
                </p>
                <a href="{{ route('admin.audit.logs') }}" class="text-emerald-400 hover:text-emerald-300 text-sm font-semibold hover:underline">Check Logs Now &rarr;</a>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full"></div>
        </div>

    </div>
</x-admin-layout>
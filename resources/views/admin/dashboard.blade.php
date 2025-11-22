<x-admin-layout>
    @section('header', 'Admin Dashboard')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-emerald-500">
            <div class="text-gray-500 text-sm font-medium uppercase">System Status</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">Operational</div>
        </div>

        <!-- Card 2: HR Users -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-slate-700">
            <div class="text-gray-500 text-sm font-medium uppercase">HR Users</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['hr_count'] }}</div>
        </div>

        <!-- Card 3: Audit Logs -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
            <div class="text-gray-500 text-sm font-medium uppercase">System Events</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['log_count'] }}</div>
            <a href="{{ route('admin.audit.logs') }}" class="text-xs text-blue-600 hover:underline mt-2 block">View Log History &rarr;</a>
        </div>
    </div>
</x-admin-layout>
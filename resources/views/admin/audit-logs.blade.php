<x-admin-layout>
    @section('header', 'System Audit Logs')

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actor (Who)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse ($logs as $log)
                    <tr class="hover:bg-gray-50 transition">
                        
                        <!-- 1. Timestamp -->
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $log->created_at->format('M d, Y H:i:s') }}
                        </td>

                        <!-- 2. Actor -->
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            @if($log->user)
                                {{ $log->user->first_name }} {{ $log->user->last_name }}
                                <span class="block text-xs text-gray-400">{{ $log->user->role }}</span>
                            @else
                                <span class="text-red-400 italic">Unknown/Deleted User</span>
                            @endif
                        </td>

                        <!-- 3. Action Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $color = match($log->action) {
                                    'CREATE' => 'bg-green-100 text-green-800',
                                    'UPDATE' => 'bg-blue-100 text-blue-800',
                                    'DELETE' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ $log->action }}
                            </span>
                        </td>

                        <!-- 4. Module (Target) -->
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            {{ $log->module }} 
                            <span class="text-xs text-gray-400">#{{ $log->target_id }}</span>
                        </td>

                        <!-- 5. Details (The JSON Data) -->
                        <td class="px-6 py-4 text-gray-500 text-xs font-mono max-w-xs truncate cursor-help" title="{{ json_encode($log->changes) }}">
                            @if($log->action == 'UPDATE')
                                <!-- Quick logic to show what changed -->
                                @php
                                    $changes = is_array($log->changes) ? $log->changes : json_decode($log->changes, true);
                                @endphp
                                @if(isset($changes['new']))
                                    Changed fields: {{ implode(', ', array_keys($changes['new'])) }}
                                @else
                                    Data updated
                                @endif
                            @else
                                {{ Str::limit(json_encode($log->changes), 50) }}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No activity recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-200">
            {{ $logs->links() }}
        </div>
    </div>
</x-admin-layout>
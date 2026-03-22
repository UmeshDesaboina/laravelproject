<x-layouts.admin title="Return Requests">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Return Requests</h1>
            <p class="text-gray-400 mt-1">Manage customer return requests</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg">
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] shadow-xl overflow-hidden">
        <div class="p-6 border-b border-[#374151]">
            <form method="GET" class="flex flex-wrap gap-4">
                <div class="w-40">
                    <select name="status" class="w-full px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <option value="">All Status</option>
                        @foreach(['pending', 'approved', 'rejected', 'received', 'refunded'] as $status)
                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-5 gap-4 p-4 bg-[#111827] border-b border-[#374151]">
            @foreach(['pending', 'approved', 'rejected', 'received', 'refunded'] as $status)
                @php
                    $colors = [
                        'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                        'approved' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                        'rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                        'received' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                        'refunded' => 'bg-green-500/20 text-green-400 border-green-500/30',
                    ];
                @endphp
                <div class="px-4 py-3 rounded-lg border {{ $colors[$status] }}">
                    <p class="text-2xl font-bold">{{ $statusCounts[$status] ?? 0 }}</p>
                    <p class="text-xs uppercase tracking-wide opacity-80">{{ $status }}</p>
                </div>
            @endforeach
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#111827]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Request</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Reason</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#374151]">
                    @forelse($returns as $ret)
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'approved' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                'rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                'received' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                'refunded' => 'bg-green-500/20 text-green-400 border-green-500/30',
                            ];
                        @endphp
                        <tr class="hover:bg-[#374151]/30 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.returns.show', $ret->id) }}" class="text-[#22c55e] hover:underline font-medium">
                                    {{ $ret->request_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-white">{{ $ret->user->name ?? 'N/A' }}</div>
                                <div class="text-gray-500 text-sm">{{ $ret->user->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-300">
                                <div class="max-w-[200px] truncate">{{ $ret->orderItem->product_name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm">
                                {{ str_replace('_', ' ', ucfirst($ret->reason)) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $statusColors[$ret->status] ?? 'bg-gray-500/20 text-gray-400 border-gray-500/30' }}">
                                    {{ ucfirst($ret->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">
                                {{ $ret->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.returns.show', $ret->id) }}" class="p-2 text-gray-400 hover:text-[#22c55e] hover:bg-[#22c55e]/10 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                No return requests found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($returns->hasPages())
            <div class="px-6 py-4 border-t border-[#374151]">
                {{ $returns->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>

<x-layouts.admin title="Coupons">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Coupons</h1>
            <p class="text-gray-400 mt-1">Manage discount coupons</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
            Add Coupon
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#111827]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Usage</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Valid Until</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#374151]">
                @forelse($coupons as $coupon)
                    <tr class="hover:bg-[#374151]/30 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-white font-mono font-medium">{{ $coupon->code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-500/20 text-blue-400">
                                {{ ucfirst($coupon->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[#22c55e] font-semibold">
                            @if($coupon->type === 'percentage')
                                {{ $coupon->value }}%
                            @else
                                ${{ number_format($coupon->value, 2) }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            {{ $coupon->used_count }}
                            @if($coupon->usage_limit)
                                / {{ $coupon->usage_limit }}
                            @else
                                / ∞
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            @if($coupon->expires_at)
                                {{ $coupon->expires_at->format('M d, Y') }}
                            @else
                                No expiry
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($coupon->is_active)
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/20 text-green-400">Active</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">No coupons found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $coupons->links() }}
    </div>
</x-layouts.admin>

<x-layouts.admin title="Customers">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Customers</h1>
        <p class="text-gray-400 mt-1">Manage customer accounts</p>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 mb-6">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                    class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
            </div>
            <div class="w-40">
                <select name="role" class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <option value="">All Roles</option>
                    <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                Search
            </button>
            @if(request()->hasAny(['search', 'role']))
                <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#111827]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Orders</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Joined</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#374151]">
                @forelse($customers as $customer)
                    <tr class="hover:bg-[#374151]/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#22c55e]/20 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-[#22c55e] font-semibold">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-white font-medium">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $customer->email }}</td>
                        <td class="px-6 py-4">
                            @if($customer->role === 'admin')
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-purple-500/20 text-purple-400">Admin</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-500/20 text-blue-400">Customer</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $customer->orders->count() }}</td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $customer->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No customers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</x-layouts.admin>

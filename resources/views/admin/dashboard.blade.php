<x-layouts.admin title="Dashboard">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        <p class="text-gray-400 mt-1">Welcome back, {{ Auth::user()->name }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 hover:border-[#22c55e]/50 transition-colors group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Orders</p>
            <p class="text-3xl font-bold text-white mt-1">{{ $stats['totalOrders'] }}</p>
            <p class="text-gray-500 text-xs mt-2">{{ $stats['pendingOrders'] }} pending</p>
        </div>

        <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 hover:border-[#22c55e]/50 transition-colors group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold text-[#22c55e] mt-1">${{ number_format($stats['totalRevenue'], 2) }}</p>
            <p class="text-gray-500 text-xs mt-2">This month: ${{ number_format($monthlyRevenue, 2) }}</p>
        </div>

        <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 hover:border-[#22c55e]/50 transition-colors group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Users</p>
            <p class="text-3xl font-bold text-white mt-1">{{ $stats['totalUsers'] }}</p>
            <p class="text-gray-500 text-xs mt-2">{{ $monthlyOrders }} orders this month</p>
        </div>

        <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 hover:border-[#22c55e]/50 transition-colors group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Products</p>
            <p class="text-3xl font-bold text-white mt-1">{{ $stats['totalProducts'] }}</p>
            <p class="text-yellow-400 text-xs mt-2">{{ $stats['lowStockProducts'] }} low stock</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
            <div class="p-6 border-b border-[#374151] flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-[#22c55e] hover:text-[#16a34a] text-sm font-medium">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#111827]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#374151]">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-[#374151]/30 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.orders.show', $order->order_number) }}" class="text-[#22c55e] hover:underline font-medium text-sm">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-300 text-sm">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-[#22c55e] font-semibold text-sm">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-500/20 text-yellow-400',
                                            'confirmed' => 'bg-blue-500/20 text-blue-400',
                                            'processing' => 'bg-blue-500/20 text-blue-400',
                                            'shipped' => 'bg-purple-500/20 text-purple-400',
                                            'delivered' => 'bg-green-500/20 text-green-400',
                                            'cancelled' => 'bg-red-500/20 text-red-400',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-400' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">No orders yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
            <div class="p-6 border-b border-[#374151]">
                <h2 class="text-lg font-semibold text-white">Top Products</h2>
            </div>
            <div class="divide-y divide-[#374151]">
                @forelse($topProducts as $product)
                    <div class="p-4 flex items-center justify-between hover:bg-[#374151]/30 transition-colors">
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-medium text-sm truncate">{{ $product->product_name }}</p>
                            <p class="text-gray-500 text-xs">{{ $product->total_sold }} sold</p>
                        </div>
                        <p class="text-[#22c55e] font-semibold text-sm">${{ number_format($product->total_revenue, 2) }}</p>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">No sales yet</div>
                @endforelse
            </div>
        </div>
    </div>

    @if($stats['pendingReturns'] > 0)
        <div class="mt-8 bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <span class="text-yellow-400 font-medium">{{ $stats['pendingReturns'] }} pending return request(s)</span>
            </div>
            <a href="{{ route('admin.returns.index', ['status' => 'pending']) }}" class="text-yellow-400 hover:text-yellow-300 font-medium">Review Now</a>
        </div>
    @endif
</x-layouts.admin>

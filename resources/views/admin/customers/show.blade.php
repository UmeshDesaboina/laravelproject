<x-layouts.admin title="Customer Details">
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Customers
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-[#22c55e]/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-[#22c55e] text-2xl font-bold">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-white">{{ $customer->name }}</h2>
                    <p class="text-gray-400">{{ $customer->email }}</p>
                    @if($customer->role === 'admin')
                        <span class="inline-block mt-2 px-3 py-1 text-xs font-medium rounded-full bg-purple-500/20 text-purple-400">Admin</span>
                    @endif
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-[#374151]">
                        <span class="text-gray-400">Member since</span>
                        <span class="text-white">{{ $customer->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-[#374151]">
                        <span class="text-gray-400">Total Orders</span>
                        <span class="text-white">{{ $customer->orders->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-[#374151]">
                        <span class="text-gray-400">Total Spent</span>
                        <span class="text-[#22c55e] font-semibold">${{ number_format($customer->orders->sum('total'), 2) }}</span>
                    </div>
                </div>
            </div>

            @if($customer->addresses->count() > 0)
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 mt-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Addresses</h3>
                    <div class="space-y-4">
                        @foreach($customer->addresses as $address)
                            <div class="p-4 bg-[#111827] rounded-lg">
                                @if($address->is_default)
                                    <span class="text-xs text-[#22c55e] font-medium">Default</span>
                                @endif
                                <p class="text-gray-300 text-sm mt-1">{{ $address->address_line_1 }}</p>
                                @if($address->address_line_2)
                                    <p class="text-gray-400 text-sm">{{ $address->address_line_2 }}</p>
                                @endif
                                <p class="text-gray-400 text-sm">{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                                <p class="text-gray-400 text-sm">{{ $address->country }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="lg:col-span-2">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
                <div class="p-6 border-b border-[#374151]">
                    <h3 class="text-lg font-semibold text-white">Recent Orders</h3>
                </div>
                @if($customer->orders->count() > 0)
                    <table class="w-full">
                        <thead class="bg-[#111827]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#374151]">
                            @foreach($customer->orders as $order)
                                <tr class="hover:bg-[#374151]/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.orders.show', $order->order_number) }}" class="text-[#22c55e] hover:underline font-medium text-sm">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
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
                                    <td class="px-6 py-4 text-[#22c55e] font-semibold text-sm">${{ number_format($order->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-12 text-center text-gray-500">No orders yet</div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>

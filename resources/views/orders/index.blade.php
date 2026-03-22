<x-layouts.shop title="My Orders">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex flex-wrap gap-3 mb-8">
            <a href="{{ route('orders.index') }}" 
               class="px-4 py-2 rounded-lg font-medium transition-colors {{ !request('status') ? 'bg-[#22c55e] text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300' }}">
                All Orders
            </a>
            @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                <a href="{{ route('orders.index', ['status' => $status]) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-colors {{ request('status') === $status ? 'bg-[#22c55e] text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300' }}">
                    {{ ucfirst($status) }}
                    @if(isset($statusCounts[$status]) && $statusCounts[$status] > 0)
                        <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('status') === $status ? 'bg-white/20' : 'bg-gray-100' }}">
                            {{ $statusCounts[$status] }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No orders found</h2>
                <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-center gap-6">
                                    <div class="grid grid-cols-3 gap-2 w-24">
                                        @foreach($order->items->take(3) as $item)
                                            @if($item->product && $item->product->images->isNotEmpty())
                                                <img src="{{ $item->product->images->first()->url }}" 
                                                     alt="{{ $item->product_name }}"
                                                     class="w-full aspect-square object-cover rounded-lg">
                                            @else
                                                <div class="w-full aspect-square bg-gray-200 rounded-lg"></div>
                                            @endif
                                        @endforeach
                                        @if($order->items->count() > 3)
                                            <div class="w-full aspect-square bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-500 font-medium">
                                                +{{ $order->items->count() - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-3 mb-1">
                                            <span class="font-semibold text-gray-900">{{ $order->order_number }}</span>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                                    'processing' => 'bg-blue-100 text-blue-800',
                                                    'shipped' => 'bg-purple-100 text-purple-800',
                                                    'delivered' => 'bg-green-100 text-green-800',
                                                    'cancelled' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500">
                                            {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }} 
                                            <span class="mx-2">•</span>
                                            Placed on {{ $order->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-[#22c55e]">${{ number_format($order->total, 2) }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->payment_status === 'paid' ? 'Paid' : 'Pending Payment' }}</p>
                                    </div>
                                    <a href="{{ route('orders.show', $order->order_number) }}" 
                                       class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layouts.shop>

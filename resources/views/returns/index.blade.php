<x-layouts.shop title="My Returns">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Return Requests</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-600">{{ session('error') }}</p>
            </div>
        @endif

        @if($returns->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No return requests</h2>
                <p class="text-gray-500 mb-6">You haven't made any return requests yet.</p>
                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    View My Orders
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($returns as $return)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    @if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty())
                                        <img src="{{ $return->orderItem->product->images->first()->url }}" 
                                             alt="{{ $return->orderItem->product_name }}"
                                             class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $return->orderItem->product_name ?? 'Product' }}</p>
                                        <p class="text-sm text-gray-500">Order: {{ $return->order->order_number ?? 'N/A' }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $return->orderItem->quantity ?? 0 }} × ${{ number_format($return->orderItem->price ?? 0, 2) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'approved' => 'bg-blue-100 text-blue-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                                'received' => 'bg-purple-100 text-purple-800',
                                                'refunded' => 'bg-green-100 text-green-800',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$return->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($return->status) }}
                                        </span>
                                        <p class="text-sm text-gray-500 mt-1">${{ number_format($return->orderItem->total ?? 0, 2) }}</p>
                                    </div>
                                    <a href="{{ route('returns.show', $return->id) }}" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex flex-wrap gap-x-8 gap-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Reason:</span> {{ str_replace('_', ' ', ucfirst($return->reason)) }}
                                    </p>
                                    @if($return->courier_name)
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Courier:</span> {{ $return->courier_name }}
                                        </p>
                                    @endif
                                    @if($return->tracking_id)
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Tracking ID:</span> <span class="font-mono">{{ $return->tracking_id }}</span>
                                        </p>
                                    @endif
                                </div>
                                @if($return->reason_description)
                                    <p class="text-sm text-gray-500 mt-1">{{ $return->reason_description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($returns->hasPages())
                <div class="mt-8">
                    {{ $returns->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layouts.shop>

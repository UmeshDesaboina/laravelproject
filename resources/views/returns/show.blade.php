<x-layouts.shop title="Return Details">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('returns.index') }}" class="hover:text-[#22c55e] transition-colors">Returns</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">{{ $return->request_number }}</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Return Request</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Request Number</p>
                        <p class="font-semibold text-gray-900">{{ $return->request_number }}</p>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-blue-100 text-blue-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'received' => 'bg-purple-100 text-purple-800',
                            'refunded' => 'bg-green-100 text-green-800',
                        ];
                    @endphp
                    <span class="px-4 py-2 text-sm font-medium rounded-full {{ $statusColors[$return->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($return->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4">Product</h3>
                <div class="flex items-center gap-4">
                    @if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty())
                        <img src="{{ Storage::url($return->orderItem->product->images->first()->image) }}" 
                             alt="{{ $return->orderItem->product_name }}"
                             class="w-20 h-20 object-cover rounded-lg">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-lg"></div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-900">{{ $return->orderItem->product_name ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">SKU: {{ $return->orderItem->sku ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $return->orderItem->quantity ?? 0 }} × ${{ number_format($return->orderItem->price ?? 0, 2) }}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-lg font-bold text-[#22c55e]">${{ number_format($return->orderItem->total ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4">Return Reason</h3>
                <p class="text-gray-700">{{ str_replace('_', ' ', ucfirst($return->reason)) }}</p>
                @if($return->reason_description)
                    <p class="text-gray-500 mt-2">{{ $return->reason_description }}</p>
                @endif
            </div>

            @if($return->resolution)
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">Resolution</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($return->resolution) }}</p>
                        </div>
                        @if($return->refund_amount)
                            <div>
                                <p class="text-sm text-gray-500">Refund Amount</p>
                                <p class="font-medium text-green-600">${{ number_format($return->refund_amount, 2) }}</p>
                            </div>
                        @endif
                        @if($return->courier_name)
                            <div>
                                <p class="text-sm text-gray-500">Courier</p>
                                <p class="font-medium text-gray-900">{{ $return->courier_name }}</p>
                            </div>
                        @endif
                        @if($return->tracking_id)
                            <div>
                                <p class="text-sm text-gray-500">Tracking ID</p>
                                <p class="font-medium text-gray-900 font-mono">{{ $return->tracking_id }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if($return->admin_notes)
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <p class="text-gray-700">{{ $return->admin_notes }}</p>
                </div>
            @endif

            <div class="p-6 bg-gray-50">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Requested on {{ $return->created_at->format('M d, Y h:i A') }}</span>
                    @if($return->processed_at)
                        <span>Processed on {{ $return->processed_at->format('M d, Y h:i A') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('orders.show', $return->order->order_number) }}" class="inline-flex items-center text-gray-600 hover:text-[#22c55e] transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Order
            </a>
        </div>
    </div>
</x-layouts.shop>

<x-layouts.admin title="Order Details">
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="{{ route('admin.orders.index') }}" class="hover:text-white transition-colors">Orders</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span>{{ $order->order_number }}</span>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">Order #{{ $order->order_number }}</h1>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                    'confirmed' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'processing' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'shipped' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                    'delivered' => 'bg-green-500/20 text-green-400 border-green-500/30',
                    'cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                ];
            @endphp
            <span class="px-4 py-2 text-sm font-medium rounded-full border {{ $statusColors[$order->status] ?? '' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg">
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Timeline</h2>
                
                @php
                    $steps = [
                        'pending' => ['label' => 'Placed', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'confirmed' => ['label' => 'Confirmed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'processing' => ['label' => 'Processing', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                        'shipped' => ['label' => 'Shipped', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                        'delivered' => ['label' => 'Delivered', 'icon' => 'M5 13l4 4L19 7'],
                    ];
                    
                    $statusOrder = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $statusOrder);
                    if ($currentIndex === false && $order->status === 'cancelled') {
                        $currentIndex = -1;
                    }
                @endphp

                <div class="relative">
                    <div class="absolute top-6 left-6 w-0.5 h-[calc(100%-3rem)] bg-[#374151]"></div>
                    
                    <div class="space-y-8">
                        @foreach($steps as $index => $step)
                            @php
                                $stepIndex = array_search($index, $statusOrder);
                                $isCompleted = $stepIndex <= $currentIndex;
                                $isCurrent = $stepIndex === $currentIndex;
                            @endphp
                            <div class="relative flex items-start pl-14">
                                <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-[#22c55e]' : 'bg-[#374151]' }} {{ $isCurrent ? 'ring-4 ring-[#22c55e]/20' : '' }}">
                                    @if($isCompleted && !$isCurrent)
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 {{ $isCurrent ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-medium {{ $isCompleted ? 'text-white' : 'text-gray-500' }}">{{ $step['label'] }}</p>
                                    @if($isCurrent)
                                        <p class="text-sm text-[#22c55e] mt-0.5">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($order->status === 'cancelled')
                            <div class="relative flex items-start pl-14">
                                <div class="absolute left-0 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center ring-4 ring-red-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-medium text-white">Cancelled</p>
                                    <p class="text-sm text-red-400 mt-0.5">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
                <div class="p-6 border-b border-[#374151]">
                    <h2 class="text-lg font-semibold text-white">Order Items</h2>
                </div>
                <div class="divide-y divide-[#374151]">
                    @foreach($order->items as $item)
                        <div class="p-6 flex items-center gap-4">
                            @if($item->product && $item->product->images->isNotEmpty())
                                <img src="{{ Storage::url($item->product->images->first()->image) }}" 
                                     alt="{{ $item->product_name }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-[#374151] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-white line-clamp-1">{{ $item->product_name }}</h3>
                                <p class="text-sm text-gray-500">SKU: {{ $item->sku }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-[#22c55e]">${{ number_format($item->total, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-6 bg-[#111827] border-t border-[#374151]">
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Subtotal</span>
                        <span class="text-white">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Shipping</span>
                        <span class="text-white">
                            @if($order->shipping_cost > 0)
                                ${{ number_format($order->shipping_cost, 2) }}
                            @else
                                Free
                            @endif
                        </span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between text-green-400 mb-2">
                            <span>Discount</span>
                            <span>-${{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-lg font-semibold text-white pt-4 border-t border-[#374151] mt-4">
                        <span>Total</span>
                        <span class="text-[#22c55e]">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Update Status</h2>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <select name="status" id="order-status" onchange="toggleTrackingFields()" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                            @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="tracking-fields" class="mb-4 space-y-4 {{ $order->status === 'shipped' ? '' : 'hidden' }}">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Courier Name</label>
                            <input type="text" name="courier_name" value="{{ $order->courier_name }}" placeholder="e.g., FedEx, UPS" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Tracking ID</label>
                            <input type="text" name="tracking_id" value="{{ $order->tracking_id }}" placeholder="Enter tracking number" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        </div>
                    </div>
                    <div id="cancellation-reason" class="mb-4 {{ $order->status === 'cancelled' ? '' : 'hidden' }}">
                        <label class="block text-sm text-gray-400 mb-2">Cancellation Reason</label>
                        <textarea name="cancellation_reason" rows="2" placeholder="Reason for cancellation" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">{{ $order->cancellation_reason }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-400 mb-2">Comment (Internal Use)</label>
                        <textarea name="comment" rows="2" placeholder="Add a comment for this status change..." class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Payment Status</h2>
                <form action="{{ route('admin.orders.update-payment-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <select name="payment_status" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                            @foreach(['pending', 'paid', 'failed', 'refunded'] as $status)
                                <option value="{{ $status }}" {{ $order->payment_status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-400 mb-2">Payment Comment</label>
                        <textarea name="comment" rows="2" placeholder="Add a comment for this payment update..." class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                        Update Payment
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Activity Logs</h2>
                <div class="space-y-4">
                    @forelse($order->statusLogs as $log)
                        <div class="relative pl-6 pb-4 border-l border-[#374151] last:pb-0">
                            <div class="absolute left-[-5px] top-1 w-2 h-2 rounded-full bg-primary shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                            <p class="text-xs font-bold text-primary uppercase tracking-widest">{{ $log->status }}</p>
                            <p class="text-sm text-gray-300 mt-1">{{ $log->comment }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-[10px] text-gray-500 font-medium">{{ $log->created_at->format('M d, Y h:i A') }}</span>
                                <span class="text-[10px] text-gray-400 italic">by {{ $log->user->name ?? 'System' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic text-center py-4">No activity logs recorded yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Customer Info</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="text-white font-medium">{{ $order->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="text-white">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Joined</p>
                        <p class="text-white">{{ $order->user->created_at->format('M d, Y') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            @if($order->address)
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                    <h2 class="text-lg font-semibold text-white mb-6">Shipping Address</h2>
                    <div class="space-y-2 text-sm">
                        <p class="text-white font-medium">{{ $order->address->full_name }}</p>
                        <p class="text-gray-400">{{ $order->address->address_line_1 }}</p>
                        @if($order->address->address_line_2)
                            <p class="text-gray-400">{{ $order->address->address_line_2 }}</p>
                        @endif
                        <p class="text-gray-400">{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->postal_code }}</p>
                        <p class="text-gray-400">{{ $order->address->country }}</p>
                        <p class="text-gray-400 mt-2">Phone: {{ $order->address->phone }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Details</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Order Date</span>
                        <span class="text-white">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Payment Method</span>
                        <span class="text-white">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                    </div>
                    @if($order->paid_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Paid At</span>
                            <span class="text-green-400">{{ $order->paid_at->format('M d, Y h:i A') }}</span>
                        </div>
                    @endif
                    @if($order->shipped_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipped At</span>
                            <span class="text-purple-400">{{ $order->shipped_at->format('M d, Y h:i A') }}</span>
                        </div>
                    @endif
                    @if($order->delivered_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Delivered At</span>
                            <span class="text-green-400">{{ $order->delivered_at->format('M d, Y h:i A') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleTrackingFields() {
            const status = document.getElementById('order-status').value;
            const trackingFields = document.getElementById('tracking-fields');
            const cancelFields = document.getElementById('cancellation-reason');
            
            if (status === 'shipped') {
                trackingFields.classList.remove('hidden');
            } else {
                trackingFields.classList.add('hidden');
            }
            
            if (status === 'cancelled') {
                cancelFields.classList.remove('hidden');
            } else {
                cancelFields.classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-layouts.admin>
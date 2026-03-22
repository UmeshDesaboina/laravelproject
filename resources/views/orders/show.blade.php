<x-layouts.shop title="Order Details">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('orders.index') }}" class="hover:text-[#22c55e] transition-colors">My Orders</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">Order #{{ $order->order_number }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Timeline</h2>
                    
                    @php
                        $steps = [
                            'pending' => ['label' => 'Order Placed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'confirmed' => ['label' => 'Confirmed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'processing' => ['label' => 'Processing', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                            'shipped' => ['label' => 'Shipped', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                            'delivered' => ['label' => 'Delivered', 'icon' => 'M5 13l4 4L19 7'],
                        ];
                        
                        $statusOrder = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statusOrder);
                        
                        $paymentStatusColors = [
                            'pending' => 'text-yellow-500',
                            'paid' => 'text-green-500',
                            'failed' => 'text-red-500',
                            'refunded' => 'text-blue-500',
                        ];
                    @endphp

                    <div class="relative">
                        <div class="absolute top-6 left-6 w-0.5 h-[calc(100%-3rem)] bg-gray-200"></div>
                        
                        <div class="space-y-8">
                            @foreach($steps as $index => $step)
                                @php
                                    $stepIndex = array_search($index, $statusOrder);
                                    $isCompleted = $stepIndex <= $currentIndex;
                                    $isCurrent = $stepIndex === $currentIndex;
                                @endphp
                                <div class="relative flex items-start pl-14">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-[#22c55e]' : 'bg-gray-200' }} {{ $isCurrent ? 'ring-4 ring-[#22c55e]/20' : '' }}">
                                        @if($isCompleted && !$isCurrent)
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 {{ $isCurrent ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 pt-1">
                                        <p class="font-medium {{ $isCompleted ? 'text-gray-900' : 'text-gray-400' }}">
                                            {{ $step['label'] }}
                                        </p>
                                        @if($isCurrent)
                                            <p class="text-sm text-[#22c55e] mt-0.5">
                                                @if($index === 'pending')
                                                    Order placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                                                @elseif($index === 'confirmed')
                                                    Confirmed on {{ $order->updated_at->format('M d, Y \a\t h:i A') }}
                                                @elseif($index === 'processing')
                                                    Being prepared for shipment
                                                @elseif($index === 'shipped')
                                                    Shipped on {{ $order->shipped_at?->format('M d, Y \a\t h:i A') ?? 'In transit' }}
                                                @elseif($index === 'delivered')
                                                    Delivered on {{ $order->delivered_at?->format('M d, Y \a\t h:i A') ?? 'Recently' }}
                                                @endif
                                            </p>
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
                                        <p class="font-medium text-gray-900">Order Cancelled</p>
                                        <p class="text-sm text-red-500 mt-0.5">This order has been cancelled</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Order Items</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <div class="p-6 flex items-center gap-4">
                                @if($item->product && $item->product->images->isNotEmpty())
                                    <img src="{{ $item->product->images->first()->url }}" 
                                         alt="{{ $item->product_name }}"
                                         class="w-20 h-20 object-cover rounded-lg">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-900 line-clamp-1">{{ $item->product_name }}</h3>
                                    <p class="text-sm text-gray-500">SKU: {{ $item->sku }}</p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <span class="text-sm text-gray-600">Qty: {{ $item->quantity }}</span>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-sm text-gray-600">${{ number_format($item->price, 2) }} each</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">${{ number_format($item->total, 2) }}</p>
                                    @if($item->discount > 0)
                                        <p class="text-sm text-green-500">-${{ number_format($item->discount, 2) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium text-gray-900">
                                @if($order->shipping_cost > 0)
                                    ${{ number_format($order->shipping_cost, 2) }}
                                @else
                                    <span class="text-green-600">Free</span>
                                @endif
                            </span>
                        </div>
                        @if($order->discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-medium">-${{ number_format($order->discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-medium text-gray-900">${{ number_format($order->tax, 2) }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-[#22c55e]">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-200">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Order Info</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Order Number</span>
                                    <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Date</span>
                                    <span class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Payment</span>
                                    <span class="font-medium {{ $paymentStatusColors[$order->payment_status] ?? 'text-gray-900' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Payment Method</span>
                                    <span class="font-medium text-gray-900">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                                </div>
                            </div>
                        </div>

                        @if($order->address)
                            <div class="pt-4 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Shipping Address</h3>
                                <p class="text-sm text-gray-600">
                                    {{ $order->address->full_name }}<br>
                                    {{ $order->address->address_line_1 }}
                                    @if($order->address->address_line_2)
                                        , {{ $order->address->address_line_2 }}
                                    @endif<br>
                                    {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->postal_code }}<br>
                                    Phone: {{ $order->address->phone }}
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($order->courier_name || $order->tracking_id)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Delivery Tracking</h3>
                            <p class="text-sm text-gray-600">
                                @if($order->courier_name)
                                    <strong>Courier:</strong> {{ $order->courier_name }}<br>
                                @endif
                                @if($order->tracking_id)
                                    <strong>Tracking ID:</strong> {{ $order->tracking_id }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if($order->returnRequests->count() > 0)
                        @foreach($order->returnRequests as $return)
                            @if($return->courier_name || $return->tracking_id)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">Return Tracking (#{{ $return->request_number }})</h3>
                                    <p class="text-sm text-gray-600">
                                        @if($return->courier_name)
                                            <strong>Courier:</strong> {{ $return->courier_name }}<br>
                                        @endif
                                        @if($return->tracking_id)
                                            <strong>Tracking ID:</strong> {{ $return->tracking_id }}
                                        @endif
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @php
                        $hasReturnableItems = $order->items->filter(function($item) {
                            return !\App\Models\ReturnRequest::where('order_item_id', $item->id)->exists();
                        })->count() > 0;
                    @endphp

                    @if($order->status === 'delivered' && $hasReturnableItems)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('returns.create', $order->order_number) }}" class="w-full py-3 px-4 border-2 border-gray-300 hover:border-[#22c55e] text-gray-700 hover:text-[#22c55e] font-medium rounded-lg transition-colors inline-block text-center">
                                Request Return
                            </a>
                        </div>
                    @endif

                    @if(in_array($order->status, ['pending', 'confirmed', 'processing']))
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <form action="{{ route('orders.cancel', $order->order_number) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cancellation Reason</label>
                                    <textarea name="reason" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" rows="2" placeholder="Please provide a reason for cancellation"></textarea>
                                </div>
                                <button type="submit" class="w-full py-3 px-4 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                                    Cancel Order
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.shop>

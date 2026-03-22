<x-layouts.admin title="Return Request Details">
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="{{ route('admin.returns.index') }}" class="hover:text-white transition-colors">Returns</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span>{{ $return->request_number }}</span>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">Return #{{ $return->request_number }}</h1>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                    'approved' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                    'received' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                    'refunded' => 'bg-green-500/20 text-green-400 border-green-500/30',
                ];
            @endphp
            <span class="px-4 py-2 text-sm font-medium rounded-full border {{ $statusColors[$return->status] ?? '' }}">
                {{ ucfirst($return->status) }}
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
                <h2 class="text-lg font-semibold text-white mb-6">Update Status</h2>
                
                <form action="{{ route('admin.returns.update-status', $return) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                @foreach(['pending', 'approved', 'rejected', 'received', 'refunded'] as $status)
                                    <option value="{{ $status }}" {{ $return->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        @if($return->status === 'pending' || $return->status === 'approved')
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Resolution</label>
                                <select name="resolution" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                    <option value="refund" {{ $return->resolution === 'refund' ? 'selected' : '' }}>Refund</option>
                                    <option value="replacement" {{ $return->resolution === 'replacement' ? 'selected' : '' }}>Replacement</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Refund Amount</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                    <input type="number" name="refund_amount" step="0.01" value="{{ $return->refund_amount ?? $return->orderItem->total ?? 0 }}" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Courier Name</label>
                                <input type="text" name="courier_name" value="{{ $return->courier_name }}" placeholder="e.g. FedEx, UPS" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Tracking ID</label>
                                <input type="text" name="tracking_id" value="{{ $return->tracking_id }}" placeholder="Enter tracking number" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Add notes about this return...">{{ $return->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Return Details</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between py-3 border-b border-[#374151]">
                        <span class="text-gray-400">Reason</span>
                        <span class="text-white">{{ str_replace('_', ' ', ucfirst($return->reason)) }}</span>
                    </div>
                    @if($return->reason_description)
                        <div class="py-3">
                            <span class="text-gray-400 block mb-2">Description</span>
                            <p class="text-white">{{ $return->reason_description }}</p>
                        </div>
                    @endif
                    @if($return->resolution)
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Resolution</span>
                            <span class="text-white">{{ ucfirst($return->resolution) }}</span>
                        </div>
                    @endif
                    @if($return->courier_name)
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Courier</span>
                            <span class="text-white">{{ $return->courier_name }}</span>
                        </div>
                    @endif
                    @if($return->tracking_id)
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Tracking ID</span>
                            <span class="text-white font-mono">{{ $return->tracking_id }}</span>
                        </div>
                    @endif
                    @if($return->refund_amount)
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Refund Amount</span>
                            <span class="text-green-400 font-semibold">${{ number_format($return->refund_amount, 2) }}</span>
                        </div>
                    @endif
                    @if($return->processed_at)
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Processed</span>
                            <span class="text-white">{{ $return->processed_at->format('M d, Y h:i A') }}</span>
                        </div>
                    @endif
                    @if($return->refunded_at)
                        <div class="flex justify-between py-3">
                            <span class="text-gray-400">Refunded</span>
                            <span class="text-green-400">{{ $return->refunded_at->format('M d, Y h:i A') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Customer</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="text-white font-medium">{{ $return->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="text-white">{{ $return->user->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            @if($return->bank_account_number)
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                    <h2 class="text-lg font-semibold text-white mb-6">Refund Bank Details</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Account Holder</p>
                            <p class="text-white font-bold text-lg mt-1">{{ $return->bank_account_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Account Number</p>
                            <p class="text-[#22c55e] font-black text-xl font-mono mt-1">{{ $return->bank_account_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">IFSC Code</p>
                            <p class="text-white font-bold text-lg mt-1 uppercase">{{ $return->bank_ifsc }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Info</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Order</p>
                        <a href="{{ route('admin.orders.show', $return->order->order_number) }}" class="text-[#22c55e] hover:underline font-medium">{{ $return->order->order_number ?? 'N/A' }}</a>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Order Date</p>
                        <p class="text-white">{{ $return->order->created_at->format('M d, Y') ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Request Date</p>
                        <p class="text-white">{{ $return->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Product</h2>
                <div class="flex items-center gap-4">
                    @if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty())
                        <img src="{{ Storage::url($return->orderItem->product->images->first()->image) }}" 
                             alt="{{ $return->orderItem->product_name }}"
                             class="w-16 h-16 object-cover rounded-lg">
                    @else
                        <div class="w-16 h-16 bg-[#374151] rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1">
                        <p class="text-white font-medium">{{ $return->orderItem->product_name ?? 'N/A' }}</p>
                        <p class="text-gray-500 text-sm">SKU: {{ $return->orderItem->sku ?? 'N/A' }}</p>
                        <p class="text-gray-500 text-sm">Qty: {{ $return->orderItem->quantity ?? 0 }} × ${{ number_format($return->orderItem->price ?? 0, 2) }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-[#374151]">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Item Total</span>
                        <span class="text-xl font-bold text-[#22c55e]">${{ number_format($return->orderItem->total ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>

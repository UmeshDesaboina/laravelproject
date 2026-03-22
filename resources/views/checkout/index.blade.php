<x-layouts.shop title="Checkout">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-[#22c55e] text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                            Shipping Address
                        </h2>
                        
                        <!-- Address logic stays here -->
                        @if($addresses->count() > 0)
                            <div class="mb-6">
                                <p class="text-sm text-gray-600 mb-3">Select a saved address:</p>
                                <div class="space-y-3">
                                    @foreach($addresses as $address)
                                        <label class="flex items-start p-4 border-2 rounded-xl cursor-pointer transition-all {{ old('address_id', $addresses->where('is_default', true)->first()?->id) == $address->id ? 'border-[#22c55e] bg-green-50' : 'border-gray-200 hover:border-gray-300' }} saved-address-label">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" {{ old('address_id', $addresses->where('is_default', true)->first()?->id) == $address->id ? 'checked' : '' }} class="mt-1 w-4 h-4 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                                            <div class="ml-3 flex-1">
                                                <p class="font-medium text-gray-900">{{ $address->full_name }}</p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $address->address_line_1 }}
                                                    @if($address->address_line_2)
                                                        , {{ $address->address_line_2 }}
                                                    @endif
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}
                                                </p>
                                                <p class="text-sm text-gray-600 mt-1">Phone: {{ $address->phone }}</p>
                                                @if($address->is_default)
                                                    <span class="inline-block mt-2 px-2 py-0.5 bg-[#22c55e] text-white text-xs rounded">Default</span>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or add new address</span>
                                </div>
                            </div>

                            <div id="new-address-form" class="mt-6 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('full_name') border-red-500 @enderror" placeholder="John Doe">
                                        @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('phone') border-red-500 @enderror" placeholder="+1 234 567 8900">
                                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line_1" value="{{ old('address_line_1') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('address_line_1') border-red-500 @enderror" placeholder="123 Main Street">
                                    @error('address_line_1') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line_2" value="{{ old('address_line_2') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" placeholder="Apartment, suite, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" value="{{ old('city') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('city') border-red-500 @enderror" placeholder="New York">
                                        @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" value="{{ old('state') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('state') border-red-500 @enderror" placeholder="NY">
                                        @error('state') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('postal_code') border-red-500 @enderror" placeholder="10001">
                                        @error('postal_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select name="country" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                                        <option value="US" {{ old('country', 'US') == 'US' ? 'selected' : '' }}>United States</option>
                                        <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                        <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('full_name') border-red-500 @enderror" placeholder="John Doe">
                                        @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('phone') border-red-500 @enderror" placeholder="+1 234 567 8900">
                                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line_1" value="{{ old('address_line_1') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('address_line_1') border-red-500 @enderror" placeholder="123 Main Street">
                                    @error('address_line_1') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line_2" value="{{ old('address_line_2') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" placeholder="Apartment, suite, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" value="{{ old('city') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('city') border-red-500 @enderror" placeholder="New York">
                                        @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" value="{{ old('state') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('state') border-red-500 @enderror" placeholder="NY">
                                        @error('state') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent @error('postal_code') border-red-500 @enderror" placeholder="10001">
                                        @error('postal_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select name="country" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                                        <option value="US" {{ old('country', 'US') == 'US' ? 'selected' : '' }}>United States</option>
                                        <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                        <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-[#22c55e] text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                            Payment Method
                        </h2>

                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 border-[#22c55e] bg-green-50 rounded-xl cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">Cash on Delivery</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1 ml-9">Pay when you receive your order</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 max-h-[400px] overflow-y-auto mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 last:border-0">
                                <div class="relative">
                                    @if($item['product']->images->isNotEmpty())
                                        <img src="{{ $item['product']->images->first()->url }}" 
                                             alt="{{ $item['product']->name }}"
                                             class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="absolute -top-2 -right-2 w-5 h-5 bg-[#22c55e] text-white text-xs font-bold rounded-full flex items-center justify-center">
                                        {{ $item['quantity'] }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $item['product']->name }}</p>
                                    <p class="text-xs text-gray-500">SKU: {{ $item['product']->sku }}</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-900">${{ number_format($item['item_total'], 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <div class="flex gap-2 mb-4">
                            <input type="text" id="coupon-code" name="code" placeholder="Coupon code" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" {{ session('coupon') ? 'value=' . session('coupon.code') : '' }}>
                            <button type="button" id="coupon-btn" onclick="window.applyCoupon(event)" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                                {{ session('coupon') ? 'Remove' : 'Apply' }}
                            </button>
                        </div>
                        
                        @if($availableCoupons->count() > 0)
                            <div class="space-y-2">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Available Coupons</p>
                                <div class="grid grid-cols-1 gap-2">
                                    @foreach($availableCoupons as $coupon)
                                        <div class="flex items-center justify-between p-2 border border-dashed border-gray-300 rounded-lg bg-gray-50 group hover:border-[#22c55e] transition-colors">
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $coupon->code }}</p>
                                                <p class="text-xs text-gray-500">
                                                    @if($coupon->type === 'percentage')
                                                        {{ (int)$coupon->value }}% off
                                                    @else
                                                        ${{ number_format($coupon->value, 2) }} off
                                                    @endif
                                                    @if($coupon->min_order_amount > 0)
                                                        on orders over ${{ number_format($coupon->min_order_amount, 2) }}
                                                    @endif
                                                </p>
                                            </div>
                                            <button type="button" onclick="window.copyAndApplyCoupon('{{ $coupon->code }}')" class="text-xs font-semibold text-[#22c55e] hover:text-[#16a34a] py-1 px-2 border border-[#22c55e] rounded hover:bg-green-50 transition-colors">
                                                Apply
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <p id="coupon-message" class="text-sm mt-2 hidden"></p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium text-gray-900">
                                @if($totalDelivery > 0)
                                    ${{ number_format($totalDelivery, 2) }}
                                @else
                                    <span class="text-green-600">Free</span>
                                @endif
                            </span>
                        </div>
                        @if($discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-medium">-${{ number_format($discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-medium text-gray-900">$0.00</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t-2 border-[#22c55e]">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-[#22c55e]">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('checkout-form').submit()" class="w-full mt-6 py-4 px-6 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg shadow-[#22c55e]/25 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Place Order
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        By placing your order, you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.shop>

@push('scripts')
<script>
        // Update label styles when radio buttons change
        document.querySelectorAll('input[name="address_id"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                document.querySelectorAll('.saved-address-label').forEach(label => {
                    label.classList.remove('border-[#22c55e]', 'bg-green-50');
                    label.classList.add('border-gray-200');
                });
                if (e.target.checked) {
                    e.target.closest('label').classList.add('border-[#22c55e]', 'bg-green-50');
                    e.target.closest('label').classList.remove('border-gray-200');
                    
                    // Clear new address fields when selecting a saved address to avoid validation confusion
                    document.querySelectorAll('#new-address-form input').forEach(input => {
                        input.value = '';
                    });
                }
            });
        });

    const isApplied = {{ session('coupon') ? 'true' : 'false' }};

    window.copyAndApplyCoupon = function(code) {
        const couponCodeInput = document.getElementById('coupon-code');
        if (couponCodeInput) {
            couponCodeInput.value = code;
            window.applyCoupon();
        }
    };

    window.applyCoupon = async function(event) {
        console.log('applyCoupon called');
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }

        const couponBtn = document.getElementById('coupon-btn');
        const couponCodeInput = document.getElementById('coupon-code');
        const couponMessage = document.getElementById('coupon-message');

        if (!couponCodeInput) {
            console.error('Coupon code input not found');
            return;
        }

        const code = couponCodeInput.value.trim();

        if (isApplied) {
            console.log('Removing coupon...');
            if (couponBtn) {
                couponBtn.disabled = true;
                couponBtn.textContent = 'Removing...';
            }
            try {
                const response = await fetch('{{ route("coupon.remove") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to remove coupon.');
                    if (couponBtn) {
                        couponBtn.disabled = false;
                        couponBtn.textContent = 'Remove';
                    }
                }
            } catch (error) {
                console.error('Coupon remove error:', error);
                alert('Something went wrong while removing the coupon.');
                if (couponBtn) {
                    couponBtn.disabled = false;
                    couponBtn.textContent = 'Remove';
                }
            }
            return;
        }

        if (!code) {
            if (couponMessage) {
                couponMessage.textContent = 'Please enter a coupon code.';
                couponMessage.className = 'text-sm mt-2 text-red-600';
                couponMessage.classList.remove('hidden');
            }
            return;
        }

        console.log('Applying coupon:', code);
        if (couponBtn) {
            couponBtn.disabled = true;
            couponBtn.textContent = 'Applying...';
        }

        try {
            const response = await fetch('{{ route("coupon.apply") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ code })
            });

            const data = await response.json();
            console.log('Coupon response:', data);
            
            if (data.success) {
                alert(data.message || 'Coupon applied successfully!');
                location.reload();
            } else {
                alert(data.message || 'Failed to apply coupon.');
                if (couponMessage) {
                    couponMessage.textContent = data.message;
                    couponMessage.className = 'text-sm mt-2 text-red-600';
                    couponMessage.classList.remove('hidden');
                }
                if (couponBtn) {
                    couponBtn.disabled = false;
                    couponBtn.textContent = 'Apply';
                }
            }
        } catch (error) {
            console.error('Coupon error:', error);
            alert('Something went wrong while applying the coupon. Please try again.');
            if (couponBtn) {
                couponBtn.disabled = false;
                couponBtn.textContent = 'Apply';
            }
        }
    };

    // Handle enter key on coupon input
    document.addEventListener('DOMContentLoaded', () => {
        const couponCodeInput = document.getElementById('coupon-code');
        if (couponCodeInput) {
            couponCodeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    window.applyCoupon();
                }
            });
        }
    });
</script>
@endpush

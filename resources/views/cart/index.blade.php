<x-layouts.shop title="Shopping Cart">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6 flex items-center gap-6" data-item-id="{{ $item['product']->id }}">
                                    <a href="{{ route('shop.show', $item['product']->slug) }}" class="flex-shrink-0">
                                        @if($item['product']->images->isNotEmpty())
                                            <img src="{{ $item['product']->images->first()->url }}" 
                                                 alt="{{ $item['product']->name }}"
                                                 class="w-24 h-24 object-cover rounded-lg">
                                        @else
                                            <div class="w-24 h-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </a>

                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('shop.show', $item['product']->slug) }}" class="block">
                                            <h3 class="text-lg font-semibold text-gray-900 hover:text-[#22c55e] transition-colors line-clamp-1">
                                                {{ $item['product']->name }}
                                            </h3>
                                        </a>
                                        <p class="text-sm text-gray-500 mt-1">{{ $item['product']->category->name ?? 'Uncategorized' }}</p>
                                        <p class="text-sm text-gray-500 mt-1">SKU: {{ $item['product']->sku }}</p>
                                        <div class="flex items-center mt-2">
                                            @if($item['product']->delivery_type === 'free')
                                                <span class="inline-flex items-center text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Free Delivery
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                                    +${{ number_format($item['delivery_charge'], 2) }} Delivery
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-6">
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <button type="button" 
                                                    onclick="window.updateQuantity({{ $item['product']->id }}, -1)"
                                                    class="px-3 py-2 text-gray-600 hover:text-[#22c55e] transition-colors rounded-l-lg hover:bg-gray-50"
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <input type="number" 
                                                   id="qty-{{ $item['product']->id }}"
                                                   value="{{ $item['quantity'] }}" 
                                                   min="1" 
                                                   max="{{ $item['product']->quantity }}"
                                                   onchange="window.setQuantity({{ $item['product']->id }}, this.value)"
                                                   class="w-12 text-center border-0 focus:outline-none text-gray-900 font-medium bg-transparent">
                                            <button type="button" 
                                                    onclick="window.updateQuantity({{ $item['product']->id }}, 1)"
                                                    class="px-3 py-2 text-gray-600 hover:text-[#22c55e] transition-colors rounded-r-lg hover:bg-gray-50"
                                                    {{ $item['quantity'] >= $item['product']->quantity ? 'disabled' : '' }}>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="text-right min-w-[100px]">
                                            <p class="text-lg font-bold text-[#22c55e]">${{ number_format($item['item_total'], 2) }}</p>
                                            @if($item['product']->compare_price)
                                                <p class="text-sm text-gray-400 line-through">${{ number_format($item['product']->compare_price * $item['quantity'], 2) }}</p>
                                            @endif
                                        </div>

                                        <button type="button" onclick="window.removeItem({{ $item['product']->id }})" 
                                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                            <a href="{{ route('shop.index') }}" class="flex items-center text-gray-600 hover:text-[#22c55e] transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Continue Shopping
                            </a>
                            <button type="button" onclick="window.clearCart(event)" class="text-red-500 hover:text-red-600 transition-colors">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ count($cartItems) }} items)</span>
                                <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-gray-600">
                                <span>Delivery</span>
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

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-[#22c55e]">${{ number_format($total, 2) }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Taxes calculated at checkout</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Have a coupon?</label>
                                <div class="flex gap-2">
                                    <input type="text" 
                                           id="cart-coupon-code"
                                           placeholder="Enter coupon code"
                                           class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                                    <button type="button" onclick="window.applyCartCoupon()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                                        Apply
                                    </button>
                                </div>
                                <p id="cart-coupon-message" class="text-sm mt-2 hidden"></p>
                            </div>

                            <button type="button" onclick="window.location.href='{{ route('checkout.index') }}'" class="w-full py-4 px-6 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg shadow-[#22c55e]/25 transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Proceed to Checkout
                            </button>

                            <div class="flex items-center justify-center gap-4 pt-4 text-gray-400">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.5 11H19V7c0-1.1-.9-2-2-2h-4V3.5C13 2.12 11.88 1 10.5 1S8 2.12 8 3.5V5H4c-1.1 0-1.99.9-1.99 2v3.8H3.5c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7H2V20c0 1.1.9 2 2 2h3.8v-1.5c0-1.49 1.21-2.7 2.7-2.7 1.49 0 2.7 1.21 2.7 2.7v1.5H19c1.1 0 2-.9 2-2v-4c1.1-.9 1.5-1.5 1.5-2.5 0-.6-.4-1.5-1-2.5z"/>
                                </svg>
                                <span class="text-sm">Secure Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
        @else
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-layouts.shop>

@push('scripts')
<script>
    window.updateQuantity = function(productId, change) {
        console.log('updateQuantity', productId, change);
        const input = document.getElementById('qty-' + productId);
        if (!input) {
            console.error('Input not found for product', productId);
            return;
        }
        
        let value = parseInt(input.value) + change;
        const max = parseInt(input.max);
        
        if (value < 1) value = 1;
        if (value > max) value = max;
        
        input.value = value;
        window.saveQuantity(productId, value);
    };

    window.setQuantity = function(productId, value) {
        console.log('setQuantity', productId, value);
        const input = document.getElementById('qty-' + productId);
        if (!input) return;
        
        const max = parseInt(input.max);
        let qty = parseInt(value);
        
        if (isNaN(qty) || qty < 1) qty = 1;
        if (qty > max) qty = max;
        
        input.value = qty;
        window.saveQuantity(productId, qty);
    };

    window.saveQuantity = function(productId, quantity) {
        console.log('saveQuantity', productId, quantity);
        fetch(`{{ url('/cart') }}/${productId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => {
            console.log('saveQuantity response', response);
            return response.json();
        })
        .then(data => {
            console.log('saveQuantity data', data);
            if (data.success) {
                location.reload();
            } else if (data.message) {
                alert(data.message);
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            alert('Failed to update quantity. Please try again.');
        });
    };

    window.removeItem = function(productId) {
        console.log('removeItem', productId);
        if (!confirm('Are you sure you want to remove this item?')) return;
        
        fetch(`{{ url('/cart') }}/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('removeItem response', response);
            return response.json();
        })
        .then(data => {
            console.log('removeItem data', data);
            if (data.success) {
                location.reload();
            } else if (data.message) {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error removing item:', error);
            alert('Failed to remove item. Please try again.');
        });
    };

    window.clearCart = function(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        if (!confirm('Are you sure you want to clear your cart?')) return;
        
        console.log('Clearing cart...');
        
        fetch('{{ route("cart.clear") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            console.log('clearCart response', response);
            return response.json();
        })
        .then(data => {
            console.log('clearCart data', data);
            if (data.success) {
                window.location.reload();
            } else if (data.message) {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error clearing cart:', error);
            // Fallback: form submission if AJAX fails
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("cart.clear") }}';
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        });
    };

    window.applyCartCoupon = function() {
        console.log('applyCartCoupon');
        const codeInput = document.getElementById('cart-coupon-code');
        const messagePara = document.getElementById('cart-coupon-message');
        if (!codeInput) return;
        
        const code = codeInput.value.trim();
        if (!code) return;

        fetch('{{ route("coupon.apply") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code: code })
        })
        .then(response => {
            console.log('applyCartCoupon response', response);
            return response.json();
        })
        .then(data => {
            console.log('applyCartCoupon data', data);
            if (data.success) {
                alert(data.message || 'Coupon applied successfully!');
                location.reload();
            } else {
                if (messagePara) {
                    messagePara.textContent = data.message;
                    messagePara.className = 'text-sm mt-2 text-red-600';
                    messagePara.classList.remove('hidden');
                }
                alert(data.message || 'Failed to apply coupon.');
            }
        })
        .catch(error => {
            console.error('Error applying coupon:', error);
            alert('Something went wrong. Please try again.');
        });
    };

    // Handle enter key on coupon input
    document.addEventListener('DOMContentLoaded', () => {
        const codeInput = document.getElementById('cart-coupon-code');
        if (codeInput) {
            codeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    window.applyCartCoupon();
                }
            });
        }
    });
</script>
@endpush

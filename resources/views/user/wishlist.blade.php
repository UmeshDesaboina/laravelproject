<x-layouts.shop title="My Wishlist">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Wishlist</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        @if($wishlists->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your wishlist is empty</h2>
                <p class="text-gray-500 mb-6">Save items you love to your wishlist and they'll be waiting for you here.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    @if($product)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                            <div class="relative aspect-square overflow-hidden bg-gray-100">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ $product->images->first()->url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <button type="button" onclick="removeFromWishlist(event, {{ $product->id }})" class="absolute top-3 right-3 p-2 bg-white/90 hover:bg-white rounded-full shadow-lg transition-colors group/remove">
                                    <svg class="w-5 h-5 text-gray-400 group-hover/remove:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-[#22c55e] transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-[#22c55e]">${{ number_format($product->price, 2) }}</span>
                                    @if($product->compare_price)
                                        <span class="text-sm text-gray-400 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" 
                                            onclick="addToCart(event, {{ $product->id }})" 
                                            {{ $product->quantity <= 0 ? 'disabled' : '' }} 
                                            class="flex-1 py-2 px-3 bg-[#22c55e] hover:bg-[#16a34a] disabled:bg-gray-300 text-white text-sm font-medium rounded-lg transition-colors">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        window.addToCart = function(event, productId) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const btn = event.currentTarget;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Adding...';

            fetch('{{ url("/cart/add") }}/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: 1 })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Product added to cart!');
                    window.location.href = '{{ route("cart.index") }}';
                } else {
                    alert(data.message || 'Error adding to cart.');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
                btn.disabled = false;
                btn.textContent = originalText;
            });
        };

        window.removeFromWishlist = function(event, productId) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            if (!confirm('Remove this item from your wishlist?')) return;
            
            fetch('{{ url("/wishlist") }}/' + productId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Error removing item.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            });
        };
    </script>
    @endpush
</x-layouts.shop>

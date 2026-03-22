<x-layouts.shop title="{{ $product->name }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="flex items-center text-xs font-bold uppercase tracking-widest text-gray-400 mb-12">
            <a href="/" class="hover:text-primary transition-colors">Home</a>
            <svg class="w-3 h-3 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('shop.index') }}" class="hover:text-primary transition-colors">Shop</a>
            <svg class="w-3 h-3 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-24">
            <div class="space-y-6" x-data="{ activeImage: 0 }">
                <div class="relative aspect-square rounded-[2.5rem] overflow-hidden bg-gray-100 group shadow-2xl">
                    @if($product->images->isNotEmpty())
                        @foreach($product->images as $index => $image)
                            <img src="{{ $image->url }}" 
                                 alt="{{ $product->name }}" 
                                 class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out"
                                 :class="activeImage === {{ $index }} ? 'opacity-100 scale-100' : 'opacity-0 scale-110'">
                        @endforeach
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    @if($product->compare_price && $product->compare_price > $product->price)
                        <span class="absolute top-8 left-8 px-6 py-2 bg-red-500 text-white text-xs font-black uppercase tracking-widest rounded-full shadow-xl">
                            Save {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                        </span>
                    @endif
                </div>
                
                @if($product->images->count() > 1)
                    <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">
                        @foreach($product->images as $index => $image)
                            <button @click="activeImage = {{ $index }}" 
                                    class="w-24 aspect-square rounded-2xl overflow-hidden border-4 transition-all flex-shrink-0"
                                    :class="activeImage === {{ $index }} ? 'border-primary shadow-lg scale-95' : 'border-transparent hover:border-gray-200'">
                                <img src="{{ $image->url }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex flex-col justify-center">
                <div class="mb-8">
                    <span class="text-xs font-black uppercase tracking-[0.2em] text-primary mb-4 block">{{ $product->category->name ?? 'Premium Gear' }}</span>
                    <h1 class="text-5xl font-black text-gray-900 tracking-tight mb-6 leading-tight">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-6 mb-8">
                        <div class="flex items-center bg-gray-100 px-3 py-1 rounded-full">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-xs font-black text-gray-500">4.9</span>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ rand(100, 500) }} Happy Customers</span>
                    </div>

                    <div class="flex items-baseline gap-4 mb-8">
                        <span class="text-5xl font-black text-primary">${{ number_format($product->price, 2) }}</span>
                        @if($product->compare_price)
                            <span class="text-2xl text-gray-300 line-through font-bold">${{ number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>

                    <p class="text-gray-500 text-lg leading-relaxed mb-10 font-medium">
                        {{ $product->short_description ?? 'Engineered for performance and durability. This professional-grade gear is built to withstand the toughest training sessions.' }}
                    </p>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="flex gap-4">
                        <div class="flex items-center bg-gray-100 rounded-2xl p-1">
                            <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                            </button>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="w-12 bg-transparent text-center font-black text-gray-900 border-none focus:ring-0">
                            <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <button type="submit" class="flex-1 btn-primary !text-lg !py-4 shadow-2xl shadow-primary/40">
                            Add to Cart
                        </button>
                    </div>
                </form>

                <div class="mt-12 pt-8 border-t border-gray-100 grid grid-cols-2 gap-8">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Free Shipping</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 21.355r-.015.015V21a11.952 11.952 0 00-8.618-3.04M12 21.355l.015.015V21a11.952 11.952 0 008.618-3.04"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>

        @if($product->description)
            <div class="mb-24">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight mb-8">Product Story</h2>
                <div class="prose prose-xl prose-gray max-w-none text-gray-500 leading-relaxed font-medium">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        @endif

        @if($relatedProducts->isNotEmpty())
            <div class="pt-24 border-t border-gray-100">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight mb-12">You May Also Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('shop.show', $related->slug) }}" class="group">
                            <div class="aspect-square rounded-[2rem] overflow-hidden bg-gray-100 mb-6 card-hover">
                                @if($related->images->isNotEmpty())
                                    <img src="{{ $related->images->first()->url }}" alt="{{ $related->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors truncate mb-1">{{ $related->name }}</h3>
                            <p class="text-primary font-black">${{ number_format($related->price, 2) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-12 bg-white rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
            
            <div class="flex flex-col md:flex-row gap-8 mb-8 pb-8 border-b border-gray-200">
                <div class="text-center">
                    <div class="text-5xl font-bold text-[#22c55e]">{{ number_format($avgRating, 1) }}</div>
                    <div class="flex text-yellow-400 mt-2 justify-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-500 mt-1">{{ $reviews->total() }} reviews</p>
                </div>
                <div class="flex-1">
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-sm text-gray-600 w-8">{{ $i }} star</span>
                            <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $reviews->total() > 0 ? (($ratingCounts[$i] ?? 0) / $reviews->total() * 100) : 0 }}%"></div>
                            </div>
                            <span class="text-sm text-gray-500 w-8">{{ $ratingCounts[$i] ?? 0 }}</span>
                        </div>
                    @endfor
                </div>
            </div>

            @auth
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Write a Review</h3>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex gap-2" x-data="{ rating: 0 }">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" @click="rating = {{ $i }}" @mouseenter="$el.parentElement.querySelectorAll('button').forEach((btn, idx) => btn.classList.toggle('text-yellow-400', idx < {{ $i }}))" class="text-gray-300 hover:text-yellow-400 transition-colors">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>
                                @endfor
                                <input type="hidden" name="rating" x-model="rating" value="0">
                            </div>
                            @error('rating') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title (Optional)</label>
                            <input type="text" name="title" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Summarize your review">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Review</label>
                            <textarea name="comment" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Share your experience with this product"></textarea>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">Submit Review</button>
                    </form>
                </div>
            @endauth

            <div class="space-y-6">
                @forelse($reviews as $review)
                    <div class="pb-6 border-b border-gray-100 last:border-0">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                    @if($review->is_verified_purchase)
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Verified Purchase</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($review->title)
                            <h4 class="font-medium text-gray-900 mb-1">{{ $review->title }}</h4>
                        @endif
                        @if($review->comment)
                            <p class="text-gray-600">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">No reviews yet. Be the first to review this product!</p>
                @endforelse
            </div>

            @if($reviews->hasPages())
                <div class="mt-6">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value) + change;
        const max = parseInt(input.max);
        if (value < 1) value = 1;
        if (value > max) value = max;
        input.value = value;
    }

    function toggleWishlist(productId) {
        const btn = document.getElementById('wishlist-btn');
        
        fetch('/wishlist/add/' + productId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (data.added) {
                    btn.classList.remove('border-gray-300', 'text-gray-600');
                    btn.classList.add('border-red-500', 'text-red-500', 'bg-red-50');
                    btn.querySelector('svg').setAttribute('fill', 'currentColor');
                    alert('Added to wishlist!');
                } else {
                    btn.classList.add('border-gray-300', 'text-gray-600');
                    btn.classList.remove('border-red-500', 'text-red-500', 'bg-red-50');
                    btn.querySelector('svg').setAttribute('fill', 'none');
                    alert('Removed from wishlist');
                }
            } else {
                if (confirm(data.message + ' Would you like to login now?')) {
                    window.location.href = '{{ route("login") }}';
                }
            }
        })
        .catch(error => {
            console.error('Error toggling wishlist:', error);
            alert('Failed to update wishlist. Please try again.');
        });
    }

    document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('add-to-cart-btn');
        const viewCartBtn = document.getElementById('view-cart-btn');
        const formData = new FormData(this);
        
        btn.disabled = true;
        btn.textContent = 'Adding...';
        
        fetch('/cart/add/' + formData.get('product_id'), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message || 'Added to cart successfully!');
                btn.textContent = 'Added!';
                btn.classList.remove('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                btn.classList.add('bg-green-600');
                viewCartBtn.classList.remove('hidden');
                
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                    cartCount.classList.remove('hidden');
                }
                
                setTimeout(() => {
                    btn.textContent = 'Add to Cart';
                    btn.classList.add('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                    btn.classList.remove('bg-green-600');
                    btn.disabled = false;
                }, 2000);
            } else {
                btn.disabled = false;
                btn.textContent = 'Add to Cart';
                if (data.redirect) {
                    if (confirm(data.message + ' Would you like to login now?')) {
                        window.location.href = data.redirect;
                    }
                } else {
                    alert(data.message || 'Something went wrong. Please try again.');
                }
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            btn.disabled = false;
            btn.textContent = 'Add to Cart';
            alert('Failed to add to cart. Please try again.');
        });
    });
    </script>
    @endpush
</x-layouts.shop>

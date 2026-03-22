<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FightWisdom - Premium Martial Arts Equipment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#111827] min-h-screen">
    <nav class="bg-[#1f2937] border-b border-[#374151] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-2xl font-bold text-[#22c55e]">FightWisdom</a>
                    <div class="hidden md:flex space-x-8">
                        <a href="/" class="text-white font-medium">Home</a>
                        <a href="{{ route('shop.index') }}" class="text-gray-400 hover:text-[#22c55e] transition-colors">Shop</a>
                        <a href="#" class="text-gray-400 hover:text-[#22c55e] transition-colors">About</a>
                        <a href="#" class="text-gray-400 hover:text-[#22c55e] transition-colors">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-[#22c55e] text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center {{ count(session('cart', [])) > 0 ? '' : 'hidden' }}">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                <span>Hi, {{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-[#1f2937] rounded-lg shadow-lg border border-[#374151] py-2 z-50">
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-gray-400 hover:text-[#22c55e] transition-colors">Dashboard</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-400 hover:text-[#22c55e] transition-colors">My Orders</a>
                                <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-400 hover:text-[#22c55e] transition-colors">Profile</a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="/admin/dashboard" class="block px-4 py-2 text-[#22c55e] font-medium transition-colors">Admin Panel</a>
                                @endif
                                <hr class="my-2 border-[#374151]">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-400 hover:text-red-400 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-[#22c55e] transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-all">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="relative bg-gradient-to-br from-[#111827] via-[#1f2937] to-[#111827] py-20 lg:py-32 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-72 h-72 bg-[#22c55e] rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#22c55e] rounded-full filter blur-3xl"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-4xl mx-auto">
                    <span class="inline-block px-4 py-1 bg-[#22c55e]/20 text-[#22c55e] text-sm font-medium rounded-full mb-6">Premium Martial Arts Equipment</span>
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                        Unleash Your <span class="text-[#22c55e]">Inner Warrior</span>
                    </h1>
                    <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
                        Discover top-tier martial arts gear, training equipment, and apparel designed for fighters who demand excellence.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('shop.index') }}" class="px-8 py-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg shadow-[#22c55e]/25">
                            Shop Now
                        </a>
                        <a href="#categories" class="px-8 py-4 border-2 border-gray-600 hover:border-[#22c55e] text-white font-semibold rounded-lg transition-all duration-200">
                            Browse Categories
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-[#1f2937]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white mb-4">Featured Products</h2>
                    <p class="text-gray-400">Handpicked gear for serious fighters</p>
                </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse(\App\Models\Product::with('images')->active()->featured()->inStock()->limit(4)->get() as $product)
                            <div class="group bg-[#111827] rounded-xl overflow-hidden border border-[#374151] hover:border-[#22c55e]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#22c55e]/10">
                                <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                    <div class="aspect-square overflow-hidden bg-[#1f2937]">
                                        @if($product->images->isNotEmpty())
                                            <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4">
                                    <a href="{{ route('shop.show', $product->slug) }}">
                                        <p class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                        <h3 class="font-semibold text-white mb-2 line-clamp-2 group-hover:text-[#22c55e] transition-colors">{{ $product->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <span class="text-lg font-bold text-[#22c55e]">${{ number_format($product->price, 2) }}</span>
                                            @if($product->compare_price)
                                                <span class="text-sm text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="mt-3 flex items-center gap-2">
                                        <button onclick="quickAddToCart({{ $product->id }}, event)" {{ $product->quantity <= 0 ? 'disabled' : '' }} class="flex-1 py-2 px-3 bg-[#22c55e] hover:bg-[#16a34a] disabled:bg-gray-700 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors">
                                            {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                        </button>
                                        <button onclick="quickToggleWishlist({{ $product->id }}, event)" class="p-2 border-2 border-gray-600 text-gray-400 hover:border-red-500 hover:text-red-500 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-4 text-center py-12 text-gray-500">
                                <p>No featured products available yet.</p>
                                <a href="{{ route('shop.index') }}" class="text-[#22c55e] hover:underline mt-2 inline-block">Browse all products</a>
                            </div>
                        @endforelse
                    </div>
            </div>
        </section>

        <section id="categories" class="py-20 bg-[#111827]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white mb-4">Shop by Category</h2>
                    <p class="text-gray-400">Find the perfect gear for your training</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse(\App\Models\Category::where('is_active', true)->root()->withCount('products')->limit(4)->get() as $category)
                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="group bg-[#1f2937] rounded-xl p-8 border border-[#374151] hover:border-[#22c55e] transition-all duration-300 text-center hover:shadow-xl hover:shadow-[#22c55e]/10">
                            <div class="w-16 h-16 mx-auto mb-4 bg-[#22c55e]/20 rounded-full flex items-center justify-center group-hover:bg-[#22c55e]/30 transition-colors">
                                <svg class="w-8 h-8 text-[#22c55e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-white mb-1">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $category->products_count }} products</p>
                        </a>
                    @empty
                        <div class="col-span-4 text-center py-12 text-gray-500">
                            <p>No categories available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-r from-[#22c55e] to-[#16a34a]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Start Your Journey?</h2>
                <p class="text-white/80 mb-8 max-w-2xl mx-auto">Join thousands of fighters who trust FightWisdom for their training needs.</p>
                <a href="{{ route('shop.index') }}" class="inline-block px-8 py-4 bg-white text-[#22c55e] font-semibold rounded-lg hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                    Explore the Shop
                </a>
            </div>
        </section>
    </main>

    <footer class="bg-[#1f2937] border-t border-[#374151] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-[#22c55e] mb-4">FightWisdom</h3>
                    <p class="text-gray-400 text-sm">Premium martial arts equipment for dedicated fighters.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-[#22c55e] transition-colors">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-[#22c55e] transition-colors">Shop</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Track Order</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Get updates on new products and offers.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-lg bg-[#111827] border border-[#374151] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        <button class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white rounded-r-lg transition-colors">Go</button>
                    </div>
                </div>
            </div>
            <div class="border-t border-[#374151] mt-8 pt-8 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} FightWisdom. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        function quickAddToCart(productId, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const btn = event.currentTarget;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Adding...';
            
            fetch('/cart/add/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                        cartCount.classList.remove('hidden');
                    }
                    btn.textContent = 'Added!';
                    btn.classList.remove('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                    btn.classList.add('bg-green-600');
                    
                    setTimeout(() => {
                        btn.disabled = false;
                        btn.textContent = originalText;
                        btn.classList.add('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                        btn.classList.remove('bg-green-600');
                    }, 2000);
                }
            })
            .catch(error => {
                btn.disabled = false;
                btn.textContent = originalText;
            });
        }

        function quickToggleWishlist(productId, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const btn = event.currentTarget;
            
            fetch('/wishlist/add/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    if (data.action === 'added') {
                        btn.classList.add('bg-red-500', 'text-white', 'border-red-500');
                        btn.classList.remove('text-gray-400', 'border-gray-600');
                    } else {
                        btn.classList.remove('bg-red-500', 'text-white', 'border-red-500');
                        btn.classList.add('text-gray-400', 'border-gray-600');
                    }
                }
            });
        }
    </script>
</body>
</html>
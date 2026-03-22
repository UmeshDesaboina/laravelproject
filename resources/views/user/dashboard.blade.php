<x-layouts.shop title="My Dashboard">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">My Dashboard</h1>
                <p class="text-gray-500 mt-2 font-medium">Welcome back, <span class="text-primary font-bold">{{ Auth::user()->name }}</span>! Here's what's happening with your account.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('shop.index') }}" class="btn-primary flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <div class="glass rounded-3xl p-8 card-hover group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-blue-500 bg-blue-500/10 px-3 py-1 rounded-full uppercase tracking-widest">Orders</span>
                </div>
                <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Orders</p>
                <p class="text-4xl font-black text-gray-900 mt-1">{{ $stats['totalOrders'] }}</p>
                <a href="{{ route('orders.index') }}" class="text-xs font-bold text-primary hover:underline mt-6 inline-block">Track Orders &rarr;</a>
            </div>

            <div class="glass rounded-3xl p-8 card-hover group border-primary/20 bg-primary/[0.02]">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-widest">Spent</span>
                </div>
                <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Spent</p>
                <p class="text-4xl font-black text-gray-900 mt-1">${{ number_format($stats['totalSpent'], 2) }}</p>
                <p class="text-xs text-gray-400 mt-6 font-medium">From successful payments</p>
            </div>

            <div class="glass rounded-3xl p-8 card-hover group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-red-500/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-red-500 bg-red-500/10 px-3 py-1 rounded-full uppercase tracking-widest">Wishlist</span>
                </div>
                <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Saved Items</p>
                <p class="text-4xl font-black text-gray-900 mt-1">{{ $stats['wishlistCount'] }}</p>
                <a href="{{ route('user.wishlist') }}" class="text-xs font-bold text-red-500 hover:underline mt-6 inline-block">View Wishlist &rarr;</a>
            </div>

            <div class="glass rounded-3xl p-8 card-hover group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-purple-500 bg-purple-500/10 px-3 py-1 rounded-full uppercase tracking-widest">Returns</span>
                </div>
                <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Returns</p>
                <p class="text-4xl font-black text-gray-900 mt-1">{{ $stats['totalReturns'] }}</p>
                <a href="{{ route('returns.index') }}" class="text-xs font-bold text-purple-500 hover:underline mt-6 inline-block">Manage Returns &rarr;</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Recent Activity</h2>
                    <a href="{{ route('orders.index') }}" class="text-sm font-bold text-primary hover:underline">View All Activity</a>
                </div>
                
                <div class="space-y-6">
                    @forelse($recentOrders as $order)
                        <div class="glass rounded-3xl p-6 flex items-center gap-6 card-hover border-gray-100">
                            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-sm font-black text-gray-900">Order #{{ $order->order_number }}</span>
                                    <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full bg-primary/10 text-primary">{{ $order->status }}</span>
                                </div>
                                <p class="text-xs text-gray-500 font-medium">Placed on {{ $order->created_at->format('M d, Y') }} • {{ $order->items->count() }} items</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-gray-900">${{ number_format($order->total, 2) }}</p>
                                <a href="{{ route('orders.show', $order->order_number) }}" class="text-xs font-bold text-primary hover:underline">Details</a>
                            </div>
                        </div>
                    @empty
                        <div class="glass rounded-3xl p-12 text-center border-dashed border-2 border-gray-200">
                            <p class="text-gray-500 font-medium">No recent orders yet. Start your journey today!</p>
                            <a href="{{ route('shop.index') }}" class="btn-primary mt-6 inline-block">Explore Shop</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="space-y-8">
                <div class="glass rounded-3xl p-8 border-gray-100">
                    <h2 class="text-xl font-black text-gray-900 mb-8 tracking-tight">Profile Summary</h2>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary font-black text-xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-black text-gray-900 text-lg leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500 font-medium">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 font-medium">Member Since</span>
                            <span class="text-gray-900 font-bold">{{ Auth::user()->created_at->format('M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 font-medium">Account Type</span>
                            <span class="text-primary font-bold uppercase tracking-widest text-[10px] bg-primary/10 px-2 py-0.5 rounded-full">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                    <a href="{{ route('user.profile') }}" class="btn-primary w-full text-center block">Edit Profile Settings</a>
                </div>

                <div class="glass rounded-3xl p-8 border-gray-100">
                    <h2 class="text-xl font-black text-gray-900 mb-6 tracking-tight">Quick Actions</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('user.addresses') }}" class="p-4 bg-gray-50 hover:bg-primary/5 rounded-2xl transition-all group text-center">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-xs font-bold text-gray-700 group-hover:text-primary">Addresses</span>
                        </a>
                        <a href="{{ route('user.wishlist') }}" class="p-4 bg-gray-50 hover:bg-primary/5 rounded-2xl transition-all group text-center">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-xs font-bold text-gray-700 group-hover:text-primary">Wishlist</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.shop>

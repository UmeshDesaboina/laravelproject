<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shop' }} - FightWisdom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="glass sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-black tracking-tighter text-primary">FightWisdom</a>
                    <div class="hidden lg:flex ml-12 space-x-10">
                        <a href="/" class="text-gray-600 hover:text-primary px-3 py-2 font-semibold transition-all hover:scale-105">Home</a>
                        <a href="{{ route('shop.index') }}" class="text-primary px-3 py-2 font-bold relative after:content-[''] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-primary">Shop</a>
                        <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 font-semibold transition-all hover:scale-105">About</a>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="hidden md:block relative group">
                        <form action="{{ route('shop.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Search products..." class="w-64 pl-10 pr-4 py-2 bg-gray-100 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('cart.index') }}" class="relative p-3 text-gray-600 hover:text-primary bg-gray-100 hover:bg-primary/10 rounded-xl transition-all hover:scale-110 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-primary text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white {{ count(session('cart', [])) > 0 ? '' : 'hidden' }}">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 pl-2 pr-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all group">
                                <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-primary transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200" 
                                 x-transition:enter-start="transform opacity-0 scale-95 translate-y-2" 
                                 x-transition:enter-end="transform opacity-100 scale-100 translate-y-0" 
                                 x-transition:leave="transition ease-in duration-75" 
                                 x-transition:leave-start="transform opacity-100 scale-100 translate-y-0" 
                                 x-transition:leave-end="transform opacity-0 scale-95 translate-y-2" 
                                 class="absolute right-0 mt-3 w-64 glass rounded-2xl shadow-2xl border border-gray-100 py-3 z-50 overflow-hidden">
                                <div class="px-4 py-2 mb-2 border-b border-gray-100">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Account</p>
                                </div>
                                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold">Dashboard</span>
                                </a>
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold">My Orders</span>
                                </a>
                                <a href="{{ route('returns.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold">My Returns</span>
                                </a>
                                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-primary/5 hover:text-primary transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold">Profile Settings</span>
                                </a>
                                <hr class="my-3 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-500 hover:bg-red-50 transition-all group">
                                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-primary transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="btn-primary !px-5 !py-2 text-sm">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-[calc(100vh-80px-300px)]">
        {{ $slot }}
    </main>

    <footer class="bg-[#1f2937] text-gray-400 py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">FightWisdom</h3>
                    <p class="text-sm">Your trusted source for premium martial arts equipment and gear.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-[#22c55e] transition-colors">Shop</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Gloves</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Pads</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Protective Gear</a></li>
                        <li><a href="#" class="hover:text-[#22c55e] transition-colors">Apparel</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Newsletter</h4>
                    <p class="text-sm mb-4">Subscribe to get special offers and updates.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-lg bg-[#374151] border border-[#4b5563] text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        <button class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white rounded-r-lg transition-colors">Go</button>
                    </div>
                </div>
            </div>
            <div class="border-t border-[#374151] mt-8 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} FightWisdom. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shop' }} - FightWisdom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f3f4f6]">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-[#22c55e]">FightWisdom</a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/" class="text-gray-700 hover:text-[#22c55e] px-3 py-2 font-medium transition-colors">Home</a>
                        <a href="{{ route('shop.index') }}" class="text-[#22c55e] px-3 py-2 font-medium">Shop</a>
                        <a href="#" class="text-gray-700 hover:text-[#22c55e] px-3 py-2 font-medium transition-colors">About</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.wishlist') }}" class="relative p-2 text-gray-600 hover:text-[#22c55e] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-[#22c55e] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-[#22c55e] text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center {{ count(session('cart', [])) > 0 ? '' : 'hidden' }}">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-gray-600 hover:text-[#22c55e] transition-colors">
                                <span>Hi, {{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        Dashboard
                                    </div>
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        My Orders
                                    </div>
                                </a>
                                <a href="{{ route('returns.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                                        </svg>
                                        My Returns
                                    </div>
                                </a>
                                <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        My Profile
                                    </div>
                                </a>
                                <hr class="my-2 border-gray-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Logout
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#22c55e] transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-[#22c55e] transition-colors">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}

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
                        <li><a href="/" class="hover:text-[#22c55e] transition-colors">Home</a></li>
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

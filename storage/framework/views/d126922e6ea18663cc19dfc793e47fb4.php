<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'My Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Dashboard']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back, <?php echo e(Auth::user()->name); ?>!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Orders</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['totalOrders']); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-[#22c55e]/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#22c55e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-400 mt-2"><?php echo e($stats['pendingOrders']); ?> in progress</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Spent</p>
                        <p class="text-3xl font-bold text-[#22c55e] mt-1">$<?php echo e(number_format($stats['totalSpent'], 2)); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-400 mt-2">Lifetime value</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Pending Returns</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($pendingReturns); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                        </svg>
                    </div>
                </div>
                <a href="<?php echo e(route('returns.index')); ?>" class="text-sm text-[#22c55e] hover:underline mt-2 inline-block">View all returns</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Account Status</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">Active</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                </div>
                <a href="<?php echo e(route('user.profile')); ?>" class="text-sm text-[#22c55e] hover:underline mt-2 inline-block">Edit profile</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Orders</h2>
                        <a href="<?php echo e(route('orders.index')); ?>" class="text-[#22c55e] hover:text-[#16a34a] text-sm font-medium">View All</a>
                    </div>
                    
                    <?php if($recentOrders->isEmpty()): ?>
                        <div class="p-12 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No orders yet</h3>
                            <p class="text-gray-500 mb-4">Start shopping to see your orders here.</p>
                            <a href="<?php echo e(route('shop.index')); ?>" class="inline-flex items-center px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                                Browse Shop
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'shipped' => 'bg-purple-100 text-purple-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                ?>
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="flex -space-x-2">
                                                <?php $__currentLoopData = $order->items->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($item->product && $item->product->images->isNotEmpty()): ?>
                                                        <img src="<?php echo e($item->product->images->first()->url); ?>" 
                                                             alt=""
                                                             class="w-12 h-12 rounded-lg object-cover border-2 border-white">
                                                    <?php else: ?>
                                                        <div class="w-12 h-12 rounded-lg bg-gray-200 border-2 border-white"></div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900"><?php echo e($order->order_number); ?></p>
                                                <p class="text-sm text-gray-500"><?php echo e($order->items->count()); ?> items • <?php echo e($order->created_at->format('M d, Y')); ?></p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo e($statusColors[$order->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                                <?php echo e(ucfirst($order->status)); ?>

                                            </span>
                                            <span class="font-semibold text-[#22c55e]">$<?php echo e(number_format($order->total, 2)); ?></span>
                                            <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h2>
                    <div class="space-y-3">
                        <a href="<?php echo e(route('orders.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-[#22c55e]/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#22c55e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">My Orders</span>
                        </a>
                        <a href="<?php echo e(route('returns.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Return Requests</span>
                        </a>
                        <a href="<?php echo e(route('user.profile')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">My Profile</span>
                        </a>
                        <a href="<?php echo e(route('user.wishlist')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-red-500/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">My Wishlist</span>
                        </a>
                        <a href="<?php echo e(route('cart.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Shopping Cart</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Account Details</h2>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-500">Name</p>
                            <p class="font-medium text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-medium text-gray-900"><?php echo e(Auth::user()->email); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Member Since</p>
                            <p class="font-medium text-gray-900"><?php echo e(Auth::user()->created_at->format('M d, Y')); ?></p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('user.profile')); ?>" class="mt-4 w-full py-2.5 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors text-center block">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97)): ?>
<?php $attributes = $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97; ?>
<?php unset($__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97)): ?>
<?php $component = $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97; ?>
<?php unset($__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97); ?>
<?php endif; ?>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/user/dashboard.blade.php ENDPATH**/ ?>
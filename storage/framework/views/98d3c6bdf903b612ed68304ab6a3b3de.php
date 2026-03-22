<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Order Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Details']); ?>
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="hover:text-white transition-colors">Orders</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span><?php echo e($order->order_number); ?></span>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">Order #<?php echo e($order->order_number); ?></h1>
            <?php
                $statusColors = [
                    'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                    'confirmed' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'processing' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'shipped' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                    'delivered' => 'bg-green-500/20 text-green-400 border-green-500/30',
                    'cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                ];
            ?>
            <span class="px-4 py-2 text-sm font-medium rounded-full border <?php echo e($statusColors[$order->status] ?? ''); ?>">
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg">
            <p class="text-green-400"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Timeline</h2>
                
                <?php
                    $steps = [
                        'pending' => ['label' => 'Placed', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'confirmed' => ['label' => 'Confirmed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'processing' => ['label' => 'Processing', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                        'shipped' => ['label' => 'Shipped', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                        'delivered' => ['label' => 'Delivered', 'icon' => 'M5 13l4 4L19 7'],
                    ];
                    
                    $statusOrder = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $statusOrder);
                    if ($currentIndex === false && $order->status === 'cancelled') {
                        $currentIndex = -1;
                    }
                ?>

                <div class="relative">
                    <div class="absolute top-6 left-6 w-0.5 h-[calc(100%-3rem)] bg-[#374151]"></div>
                    
                    <div class="space-y-8">
                        <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $stepIndex = array_search($index, $statusOrder);
                                $isCompleted = $stepIndex <= $currentIndex;
                                $isCurrent = $stepIndex === $currentIndex;
                            ?>
                            <div class="relative flex items-start pl-14">
                                <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center <?php echo e($isCompleted ? 'bg-[#22c55e]' : 'bg-[#374151]'); ?> <?php echo e($isCurrent ? 'ring-4 ring-[#22c55e]/20' : ''); ?>">
                                    <?php if($isCompleted && !$isCurrent): ?>
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-6 h-6 <?php echo e($isCurrent ? 'text-white' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($step['icon']); ?>"></path>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-medium <?php echo e($isCompleted ? 'text-white' : 'text-gray-500'); ?>"><?php echo e($step['label']); ?></p>
                                    <?php if($isCurrent): ?>
                                        <p class="text-sm text-[#22c55e] mt-0.5"><?php echo e($order->updated_at->format('M d, Y h:i A')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($order->status === 'cancelled'): ?>
                            <div class="relative flex items-start pl-14">
                                <div class="absolute left-0 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center ring-4 ring-red-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-medium text-white">Cancelled</p>
                                    <p class="text-sm text-red-400 mt-0.5"><?php echo e($order->updated_at->format('M d, Y h:i A')); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
                <div class="p-6 border-b border-[#374151]">
                    <h2 class="text-lg font-semibold text-white">Order Items</h2>
                </div>
                <div class="divide-y divide-[#374151]">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-6 flex items-center gap-4">
                            <?php if($item->product && $item->product->images->isNotEmpty()): ?>
                                <img src="<?php echo e(Storage::url($item->product->images->first()->image)); ?>" 
                                     alt="<?php echo e($item->product_name); ?>"
                                     class="w-16 h-16 object-cover rounded-lg">
                            <?php else: ?>
                                <div class="w-16 h-16 bg-[#374151] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-white line-clamp-1"><?php echo e($item->product_name); ?></h3>
                                <p class="text-sm text-gray-500">SKU: <?php echo e($item->sku); ?></p>
                                <p class="text-sm text-gray-500">Qty: <?php echo e($item->quantity); ?> × $<?php echo e(number_format($item->price, 2)); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-[#22c55e]">$<?php echo e(number_format($item->total, 2)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="p-6 bg-[#111827] border-t border-[#374151]">
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Subtotal</span>
                        <span class="text-white">$<?php echo e(number_format($order->subtotal, 2)); ?></span>
                    </div>
                    <div class="flex justify-between text-gray-400 mb-2">
                        <span>Shipping</span>
                        <span class="text-white">
                            <?php if($order->shipping_cost > 0): ?>
                                $<?php echo e(number_format($order->shipping_cost, 2)); ?>

                            <?php else: ?>
                                Free
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($order->discount > 0): ?>
                        <div class="flex justify-between text-green-400 mb-2">
                            <span>Discount</span>
                            <span>-$<?php echo e(number_format($order->discount, 2)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="flex justify-between text-lg font-semibold text-white pt-4 border-t border-[#374151] mt-4">
                        <span>Total</span>
                        <span class="text-[#22c55e]">$<?php echo e(number_format($order->total, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Update Status</h2>
                <form action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="mb-4">
                        <select name="status" id="order-status" onchange="toggleTrackingFields()" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                            <?php $__currentLoopData = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>" <?php echo e($order->status === $status ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($status)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div id="tracking-fields" class="mb-4 space-y-4 <?php echo e($order->status === 'shipped' ? '' : 'hidden'); ?>">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Courier Name</label>
                            <input type="text" name="courier_name" value="<?php echo e($order->courier_name); ?>" placeholder="e.g., FedEx, UPS" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Tracking ID</label>
                            <input type="text" name="tracking_id" value="<?php echo e($order->tracking_id); ?>" placeholder="Enter tracking number" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                        </div>
                    </div>
                    <div id="cancellation-reason" class="mb-4 <?php echo e($order->status === 'cancelled' ? '' : 'hidden'); ?>">
                        <label class="block text-sm text-gray-400 mb-2">Cancellation Reason</label>
                        <textarea name="cancellation_reason" rows="2" placeholder="Reason for cancellation" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]"><?php echo e($order->cancellation_reason); ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-400 mb-2">Comment (Internal Use)</label>
                        <textarea name="comment" rows="2" placeholder="Add a comment for this status change..." class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Payment Status</h2>
                <form action="<?php echo e(route('admin.orders.update-payment-status', $order)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="mb-4">
                        <select name="payment_status" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                            <?php $__currentLoopData = ['pending', 'paid', 'failed', 'refunded']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>" <?php echo e($order->payment_status === $status ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($status)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-gray-400 mb-2">Payment Comment</label>
                        <textarea name="comment" rows="2" placeholder="Add a comment for this payment update..." class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e]"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                        Update Payment
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Activity Logs</h2>
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $order->statusLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="relative pl-6 pb-4 border-l border-[#374151] last:pb-0">
                            <div class="absolute left-[-5px] top-1 w-2 h-2 rounded-full bg-primary shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                            <p class="text-xs font-bold text-primary uppercase tracking-widest"><?php echo e($log->status); ?></p>
                            <p class="text-sm text-gray-300 mt-1"><?php echo e($log->comment); ?></p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-[10px] text-gray-500 font-medium"><?php echo e($log->created_at->format('M d, Y h:i A')); ?></span>
                                <span class="text-[10px] text-gray-400 italic">by <?php echo e($log->user->name ?? 'System'); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500 italic text-center py-4">No activity logs recorded yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Customer Info</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="text-white font-medium"><?php echo e($order->user->name ?? 'N/A'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="text-white"><?php echo e($order->user->email ?? 'N/A'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Joined</p>
                        <p class="text-white"><?php echo e($order->user->created_at->format('M d, Y') ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <?php if($order->address): ?>
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                    <h2 class="text-lg font-semibold text-white mb-6">Shipping Address</h2>
                    <div class="space-y-2 text-sm">
                        <p class="text-white font-medium"><?php echo e($order->address->full_name); ?></p>
                        <p class="text-gray-400"><?php echo e($order->address->address_line_1); ?></p>
                        <?php if($order->address->address_line_2): ?>
                            <p class="text-gray-400"><?php echo e($order->address->address_line_2); ?></p>
                        <?php endif; ?>
                        <p class="text-gray-400"><?php echo e($order->address->city); ?>, <?php echo e($order->address->state); ?> <?php echo e($order->address->postal_code); ?></p>
                        <p class="text-gray-400"><?php echo e($order->address->country); ?></p>
                        <p class="text-gray-400 mt-2">Phone: <?php echo e($order->address->phone); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Details</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Order Date</span>
                        <span class="text-white"><?php echo e($order->created_at->format('M d, Y h:i A')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Payment Method</span>
                        <span class="text-white"><?php echo e(str_replace('_', ' ', ucfirst($order->payment_method))); ?></span>
                    </div>
                    <?php if($order->paid_at): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Paid At</span>
                            <span class="text-green-400"><?php echo e($order->paid_at->format('M d, Y h:i A')); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($order->shipped_at): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipped At</span>
                            <span class="text-purple-400"><?php echo e($order->shipped_at->format('M d, Y h:i A')); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($order->delivered_at): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Delivered At</span>
                            <span class="text-green-400"><?php echo e($order->delivered_at->format('M d, Y h:i A')); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        function toggleTrackingFields() {
            const status = document.getElementById('order-status').value;
            const trackingFields = document.getElementById('tracking-fields');
            const cancelFields = document.getElementById('cancellation-reason');
            
            if (status === 'shipped') {
                trackingFields.classList.remove('hidden');
            } else {
                trackingFields.classList.add('hidden');
            }
            
            if (status === 'cancelled') {
                cancelFields.classList.remove('hidden');
            } else {
                cancelFields.classList.add('hidden');
            }
        }
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?><?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>
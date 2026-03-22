<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Order Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Details']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="<?php echo e(route('orders.index')); ?>" class="hover:text-[#22c55e] transition-colors">My Orders</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">Order #<?php echo e($order->order_number); ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Timeline</h2>
                    
                    <?php
                        $steps = [
                            'pending' => ['label' => 'Order Placed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'confirmed' => ['label' => 'Confirmed', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'processing' => ['label' => 'Processing', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                            'shipped' => ['label' => 'Shipped', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                            'delivered' => ['label' => 'Delivered', 'icon' => 'M5 13l4 4L19 7'],
                        ];
                        
                        $statusOrder = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statusOrder);
                        
                        $paymentStatusColors = [
                            'pending' => 'text-yellow-500',
                            'paid' => 'text-green-500',
                            'failed' => 'text-red-500',
                            'refunded' => 'text-blue-500',
                        ];
                    ?>

                    <div class="relative">
                        <div class="absolute top-6 left-6 w-0.5 h-[calc(100%-3rem)] bg-gray-200"></div>
                        
                        <div class="space-y-8">
                            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $stepIndex = array_search($index, $statusOrder);
                                    $isCompleted = $stepIndex <= $currentIndex;
                                    $isCurrent = $stepIndex === $currentIndex;
                                ?>
                                <div class="relative flex items-start pl-14">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center <?php echo e($isCompleted ? 'bg-[#22c55e]' : 'bg-gray-200'); ?> <?php echo e($isCurrent ? 'ring-4 ring-[#22c55e]/20' : ''); ?>">
                                        <?php if($isCompleted && !$isCurrent): ?>
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        <?php else: ?>
                                            <svg class="w-6 h-6 <?php echo e($isCurrent ? 'text-white' : 'text-gray-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($step['icon']); ?>"></path>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 pt-1">
                                        <p class="font-medium <?php echo e($isCompleted ? 'text-gray-900' : 'text-gray-400'); ?>">
                                            <?php echo e($step['label']); ?>

                                        </p>
                                        <?php if($isCurrent): ?>
                                            <p class="text-sm text-[#22c55e] mt-0.5">
                                                <?php if($index === 'pending'): ?>
                                                    Order placed on <?php echo e($order->created_at->format('M d, Y \a\t h:i A')); ?>

                                                <?php elseif($index === 'confirmed'): ?>
                                                    Confirmed on <?php echo e($order->updated_at->format('M d, Y \a\t h:i A')); ?>

                                                <?php elseif($index === 'processing'): ?>
                                                    Being prepared for shipment
                                                <?php elseif($index === 'shipped'): ?>
                                                    Shipped on <?php echo e($order->shipped_at?->format('M d, Y \a\t h:i A') ?? 'In transit'); ?>

                                                <?php elseif($index === 'delivered'): ?>
                                                    Delivered on <?php echo e($order->delivered_at?->format('M d, Y \a\t h:i A') ?? 'Recently'); ?>

                                                <?php endif; ?>
                                            </p>
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
                                        <p class="font-medium text-gray-900">Order Cancelled</p>
                                        <p class="text-sm text-red-500 mt-0.5">This order has been cancelled</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Order Items</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-6 flex items-center gap-4">
                                <?php if($item->product && $item->product->images->isNotEmpty()): ?>
                                    <img src="<?php echo e($item->product->images->first()->url); ?>" 
                                         alt="<?php echo e($item->product_name); ?>"
                                         class="w-20 h-20 object-cover rounded-lg">
                                <?php else: ?>
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-900 line-clamp-1"><?php echo e($item->product_name); ?></h3>
                                    <p class="text-sm text-gray-500">SKU: <?php echo e($item->sku); ?></p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <span class="text-sm text-gray-600">Qty: <?php echo e($item->quantity); ?></span>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-sm text-gray-600">$<?php echo e(number_format($item->price, 2)); ?> each</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">$<?php echo e(number_format($item->total, 2)); ?></p>
                                    <?php if($item->discount > 0): ?>
                                        <p class="text-sm text-green-500">-$<?php echo e(number_format($item->discount, 2)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">$<?php echo e(number_format($order->subtotal, 2)); ?></span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium text-gray-900">
                                <?php if($order->shipping_cost > 0): ?>
                                    $<?php echo e(number_format($order->shipping_cost, 2)); ?>

                                <?php else: ?>
                                    <span class="text-green-600">Free</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if($order->discount > 0): ?>
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-medium">-$<?php echo e(number_format($order->discount, 2)); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-medium text-gray-900">$<?php echo e(number_format($order->tax, 2)); ?></span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-[#22c55e]">$<?php echo e(number_format($order->total, 2)); ?></span>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-200">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Order Info</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Order Number</span>
                                    <span class="font-medium text-gray-900"><?php echo e($order->order_number); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Date</span>
                                    <span class="font-medium text-gray-900"><?php echo e($order->created_at->format('M d, Y')); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Payment</span>
                                    <span class="font-medium <?php echo e($paymentStatusColors[$order->payment_status] ?? 'text-gray-900'); ?>">
                                        <?php echo e(ucfirst($order->payment_status)); ?>

                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Payment Method</span>
                                    <span class="font-medium text-gray-900"><?php echo e(str_replace('_', ' ', ucfirst($order->payment_method))); ?></span>
                                </div>
                            </div>
                        </div>

                        <?php if($order->address): ?>
                            <div class="pt-4 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Shipping Address</h3>
                                <p class="text-sm text-gray-600">
                                    <?php echo e($order->address->full_name); ?><br>
                                    <?php echo e($order->address->address_line_1); ?>

                                    <?php if($order->address->address_line_2): ?>
                                        , <?php echo e($order->address->address_line_2); ?>

                                    <?php endif; ?><br>
                                    <?php echo e($order->address->city); ?>, <?php echo e($order->address->state); ?> <?php echo e($order->address->postal_code); ?><br>
                                    Phone: <?php echo e($order->address->phone); ?>

                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if($order->courier_name || $order->tracking_id): ?>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Delivery Tracking</h3>
                            <p class="text-sm text-gray-600">
                                <?php if($order->courier_name): ?>
                                    <strong>Courier:</strong> <?php echo e($order->courier_name); ?><br>
                                <?php endif; ?>
                                <?php if($order->tracking_id): ?>
                                    <strong>Tracking ID:</strong> <?php echo e($order->tracking_id); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if($order->returnRequests->count() > 0): ?>
                        <?php $__currentLoopData = $order->returnRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($return->courier_name || $return->tracking_id): ?>
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">Return Tracking (#<?php echo e($return->request_number); ?>)</h3>
                                    <p class="text-sm text-gray-600">
                                        <?php if($return->courier_name): ?>
                                            <strong>Courier:</strong> <?php echo e($return->courier_name); ?><br>
                                        <?php endif; ?>
                                        <?php if($return->tracking_id): ?>
                                            <strong>Tracking ID:</strong> <?php echo e($return->tracking_id); ?>

                                        <?php endif; ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php
                        $hasReturnableItems = $order->items->filter(function($item) {
                            return !\App\Models\ReturnRequest::where('order_item_id', $item->id)->exists();
                        })->count() > 0;
                    ?>

                    <?php if($order->status === 'delivered' && $hasReturnableItems): ?>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="<?php echo e(route('returns.create', $order->order_number)); ?>" class="w-full py-3 px-4 border-2 border-gray-300 hover:border-[#22c55e] text-gray-700 hover:text-[#22c55e] font-medium rounded-lg transition-colors inline-block text-center">
                                Request Return
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(in_array($order->status, ['pending', 'confirmed', 'processing'])): ?>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <form action="<?php echo e(route('orders.cancel', $order->order_number)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                <?php echo csrf_field(); ?>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cancellation Reason</label>
                                    <textarea name="reason" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" rows="2" placeholder="Please provide a reason for cancellation"></textarea>
                                </div>
                                <button type="submit" class="w-full py-3 px-4 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                                    Cancel Order
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/orders/show.blade.php ENDPATH**/ ?>
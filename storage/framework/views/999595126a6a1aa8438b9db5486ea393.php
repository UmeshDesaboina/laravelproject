<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Order Confirmed']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Confirmed']); ?>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-[#22c55e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
            <p class="text-gray-600 mb-6">Thank you for your purchase. Your order has been placed successfully.</p>

            <div class="bg-gray-50 rounded-xl p-6 mb-8">
                <div class="grid grid-cols-2 gap-4 text-left">
                    <div>
                        <p class="text-sm text-gray-500">Order Number</p>
                        <p class="font-semibold text-gray-900"><?php echo e($order->order_number); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date</p>
                        <p class="font-semibold text-gray-900"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">
                            Pending
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Payment Method</p>
                        <p class="font-semibold text-gray-900 capitalize"><?php echo e(str_replace('_', ' ', $order->payment_method)); ?></p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6 mb-6">
                <h3 class="text-left font-semibold text-gray-900 mb-4">Order Details</h3>
                <div class="space-y-4">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-left">
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-500"><?php echo e($item->quantity); ?>x</span>
                                <span class="font-medium text-gray-900"><?php echo e($item->product_name); ?></span>
                            </div>
                            <span class="font-semibold text-gray-900">$<?php echo e(number_format($item->total, 2)); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 mb-8">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-900">Total Amount</span>
                    <span class="text-2xl font-bold text-[#22c55e]">$<?php echo e(number_format($order->total, 2)); ?></span>
                </div>
            </div>

            <?php if($order->address): ?>
                <div class="text-left mb-8">
                    <h3 class="font-semibold text-gray-900 mb-2">Shipping Address</h3>
                    <p class="text-gray-600">
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

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e(route('shop.index')); ?>" class="flex-1 py-3 px-6 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-all text-center">
                    Continue Shopping
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('orders.index')); ?>" class="flex-1 py-3 px-6 border-2 border-gray-300 hover:border-[#22c55e] text-gray-700 hover:text-[#22c55e] font-semibold rounded-lg transition-all text-center">
                        View Orders
                    </a>
                <?php endif; ?>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/checkout/success.blade.php ENDPATH**/ ?>
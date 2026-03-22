<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Return Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Return Details']); ?>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="<?php echo e(route('returns.index')); ?>" class="hover:text-[#22c55e] transition-colors">Returns</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900"><?php echo e($return->request_number); ?></span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Return Request</h1>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Request Number</p>
                        <p class="font-semibold text-gray-900"><?php echo e($return->request_number); ?></p>
                    </div>
                    <?php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-blue-100 text-blue-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'received' => 'bg-purple-100 text-purple-800',
                            'refunded' => 'bg-green-100 text-green-800',
                        ];
                    ?>
                    <span class="px-4 py-2 text-sm font-medium rounded-full <?php echo e($statusColors[$return->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                        <?php echo e(ucfirst($return->status)); ?>

                    </span>
                </div>
            </div>

            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4">Product</h3>
                <div class="flex items-center gap-4">
                    <?php if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty()): ?>
                        <img src="<?php echo e(Storage::url($return->orderItem->product->images->first()->image)); ?>" 
                             alt="<?php echo e($return->orderItem->product_name); ?>"
                             class="w-20 h-20 object-cover rounded-lg">
                    <?php else: ?>
                        <div class="w-20 h-20 bg-gray-200 rounded-lg"></div>
                    <?php endif; ?>
                    <div>
                        <p class="font-medium text-gray-900"><?php echo e($return->orderItem->product_name ?? 'N/A'); ?></p>
                        <p class="text-sm text-gray-500">SKU: <?php echo e($return->orderItem->sku ?? 'N/A'); ?></p>
                        <p class="text-sm text-gray-500">Qty: <?php echo e($return->orderItem->quantity ?? 0); ?> × $<?php echo e(number_format($return->orderItem->price ?? 0, 2)); ?></p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-lg font-bold text-[#22c55e]">$<?php echo e(number_format($return->orderItem->total ?? 0, 2)); ?></p>
                    </div>
                </div>
            </div>

            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4">Return Reason</h3>
                <p class="text-gray-700"><?php echo e(str_replace('_', ' ', ucfirst($return->reason))); ?></p>
                <?php if($return->reason_description): ?>
                    <p class="text-gray-500 mt-2"><?php echo e($return->reason_description); ?></p>
                <?php endif; ?>
            </div>

            <?php if($return->resolution): ?>
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">Resolution</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="font-medium text-gray-900"><?php echo e(ucfirst($return->resolution)); ?></p>
                        </div>
                        <?php if($return->refund_amount): ?>
                            <div>
                                <p class="text-sm text-gray-500">Refund Amount</p>
                                <p class="font-medium text-green-600">$<?php echo e(number_format($return->refund_amount, 2)); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if($return->courier_name): ?>
                            <div>
                                <p class="text-sm text-gray-500">Courier</p>
                                <p class="font-medium text-gray-900"><?php echo e($return->courier_name); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if($return->tracking_id): ?>
                            <div>
                                <p class="text-sm text-gray-500">Tracking ID</p>
                                <p class="font-medium text-gray-900 font-mono"><?php echo e($return->tracking_id); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($return->admin_notes): ?>
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <p class="text-gray-700"><?php echo e($return->admin_notes); ?></p>
                </div>
            <?php endif; ?>

            <div class="p-6 bg-gray-50">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Requested on <?php echo e($return->created_at->format('M d, Y h:i A')); ?></span>
                    <?php if($return->processed_at): ?>
                        <span>Processed on <?php echo e($return->processed_at->format('M d, Y h:i A')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="<?php echo e(route('orders.show', $return->order->order_number)); ?>" class="inline-flex items-center text-gray-600 hover:text-[#22c55e] transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Order
            </a>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/returns/show.blade.php ENDPATH**/ ?>
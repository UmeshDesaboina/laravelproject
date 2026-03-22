<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'My Returns']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Returns']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Return Requests</h1>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-600"><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?>

        <?php if($returns->isEmpty()): ?>
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No return requests</h2>
                <p class="text-gray-500 mb-6">You haven't made any return requests yet.</p>
                <a href="<?php echo e(route('orders.index')); ?>" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    View My Orders
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $returns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <?php if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty()): ?>
                                        <img src="<?php echo e($return->orderItem->product->images->first()->url); ?>" 
                                             alt="<?php echo e($return->orderItem->product_name); ?>"
                                             class="w-16 h-16 object-cover rounded-lg">
                                    <?php else: ?>
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-semibold text-gray-900"><?php echo e($return->orderItem->product_name ?? 'Product'); ?></p>
                                        <p class="text-sm text-gray-500">Order: <?php echo e($return->order->order_number ?? 'N/A'); ?></p>
                                        <p class="text-sm text-gray-500">Qty: <?php echo e($return->orderItem->quantity ?? 0); ?> × $<?php echo e(number_format($return->orderItem->price ?? 0, 2)); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        <?php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'approved' => 'bg-blue-100 text-blue-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                                'received' => 'bg-purple-100 text-purple-800',
                                                'refunded' => 'bg-green-100 text-green-800',
                                            ];
                                        ?>
                                        <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo e($statusColors[$return->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                            <?php echo e(ucfirst($return->status)); ?>

                                        </span>
                                        <p class="text-sm text-gray-500 mt-1">$<?php echo e(number_format($return->orderItem->total ?? 0, 2)); ?></p>
                                    </div>
                                    <a href="<?php echo e(route('returns.show', $return->id)); ?>" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex flex-wrap gap-x-8 gap-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Reason:</span> <?php echo e(str_replace('_', ' ', ucfirst($return->reason))); ?>

                                    </p>
                                    <?php if($return->courier_name): ?>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Courier:</span> <?php echo e($return->courier_name); ?>

                                        </p>
                                    <?php endif; ?>
                                    <?php if($return->tracking_id): ?>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Tracking ID:</span> <span class="font-mono"><?php echo e($return->tracking_id); ?></span>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php if($return->reason_description): ?>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo e($return->reason_description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($returns->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($returns->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/returns/index.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Return Request Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Return Request Details']); ?>
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="<?php echo e(route('admin.returns.index')); ?>" class="hover:text-white transition-colors">Returns</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span><?php echo e($return->request_number); ?></span>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">Return #<?php echo e($return->request_number); ?></h1>
            <?php
                $statusColors = [
                    'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                    'approved' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                    'rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                    'received' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                    'refunded' => 'bg-green-500/20 text-green-400 border-green-500/30',
                ];
            ?>
            <span class="px-4 py-2 text-sm font-medium rounded-full border <?php echo e($statusColors[$return->status] ?? ''); ?>">
                <?php echo e(ucfirst($return->status)); ?>

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
                <h2 class="text-lg font-semibold text-white mb-6">Update Status</h2>
                
                <form action="<?php echo e(route('admin.returns.update-status', $return)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                <?php $__currentLoopData = ['pending', 'approved', 'rejected', 'received', 'refunded']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status); ?>" <?php echo e($return->status === $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <?php if($return->status === 'pending' || $return->status === 'approved'): ?>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Resolution</label>
                                <select name="resolution" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                    <option value="refund" <?php echo e($return->resolution === 'refund' ? 'selected' : ''); ?>>Refund</option>
                                    <option value="replacement" <?php echo e($return->resolution === 'replacement' ? 'selected' : ''); ?>>Replacement</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Refund Amount</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                    <input type="number" name="refund_amount" step="0.01" value="<?php echo e($return->refund_amount ?? $return->orderItem->total ?? 0); ?>" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Courier Name</label>
                                <input type="text" name="courier_name" value="<?php echo e($return->courier_name); ?>" placeholder="e.g. FedEx, UPS" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Tracking ID</label>
                                <input type="text" name="tracking_id" value="<?php echo e($return->tracking_id); ?>" placeholder="Enter tracking number" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Add notes about this return..."><?php echo e($return->admin_notes); ?></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Return Details</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between py-3 border-b border-[#374151]">
                        <span class="text-gray-400">Reason</span>
                        <span class="text-white"><?php echo e(str_replace('_', ' ', ucfirst($return->reason))); ?></span>
                    </div>
                    <?php if($return->reason_description): ?>
                        <div class="py-3">
                            <span class="text-gray-400 block mb-2">Description</span>
                            <p class="text-white"><?php echo e($return->reason_description); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if($return->resolution): ?>
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Resolution</span>
                            <span class="text-white"><?php echo e(ucfirst($return->resolution)); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($return->courier_name): ?>
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Courier</span>
                            <span class="text-white"><?php echo e($return->courier_name); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($return->tracking_id): ?>
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Tracking ID</span>
                            <span class="text-white font-mono"><?php echo e($return->tracking_id); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($return->refund_amount): ?>
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Refund Amount</span>
                            <span class="text-green-400 font-semibold">$<?php echo e(number_format($return->refund_amount, 2)); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($return->processed_at): ?>
                        <div class="flex justify-between py-3 border-b border-[#374151]">
                            <span class="text-gray-400">Processed</span>
                            <span class="text-white"><?php echo e($return->processed_at->format('M d, Y h:i A')); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($return->refunded_at): ?>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-400">Refunded</span>
                            <span class="text-green-400"><?php echo e($return->refunded_at->format('M d, Y h:i A')); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Customer</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="text-white font-medium"><?php echo e($return->user->name ?? 'N/A'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="text-white"><?php echo e($return->user->email ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <?php if($return->bank_account_number): ?>
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                    <h2 class="text-lg font-semibold text-white mb-6">Refund Bank Details</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Account Holder</p>
                            <p class="text-white font-bold text-lg mt-1"><?php echo e($return->bank_account_name); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Account Number</p>
                            <p class="text-[#22c55e] font-black text-xl font-mono mt-1"><?php echo e($return->bank_account_number); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">IFSC Code</p>
                            <p class="text-white font-bold text-lg mt-1 uppercase"><?php echo e($return->bank_ifsc); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Order Info</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Order</p>
                        <a href="<?php echo e(route('admin.orders.show', $return->order->order_number)); ?>" class="text-[#22c55e] hover:underline font-medium"><?php echo e($return->order->order_number ?? 'N/A'); ?></a>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Order Date</p>
                        <p class="text-white"><?php echo e($return->order->created_at->format('M d, Y') ?? 'N/A'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Request Date</p>
                        <p class="text-white"><?php echo e($return->created_at->format('M d, Y h:i A')); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
                <h2 class="text-lg font-semibold text-white mb-6">Product</h2>
                <div class="flex items-center gap-4">
                    <?php if($return->orderItem && $return->orderItem->product && $return->orderItem->product->images->isNotEmpty()): ?>
                        <img src="<?php echo e(Storage::url($return->orderItem->product->images->first()->image)); ?>" 
                             alt="<?php echo e($return->orderItem->product_name); ?>"
                             class="w-16 h-16 object-cover rounded-lg">
                    <?php else: ?>
                        <div class="w-16 h-16 bg-[#374151] rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div class="flex-1">
                        <p class="text-white font-medium"><?php echo e($return->orderItem->product_name ?? 'N/A'); ?></p>
                        <p class="text-gray-500 text-sm">SKU: <?php echo e($return->orderItem->sku ?? 'N/A'); ?></p>
                        <p class="text-gray-500 text-sm">Qty: <?php echo e($return->orderItem->quantity ?? 0); ?> × $<?php echo e(number_format($return->orderItem->price ?? 0, 2)); ?></p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-[#374151]">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Item Total</span>
                        <span class="text-xl font-bold text-[#22c55e]">$<?php echo e(number_format($return->orderItem->total ?? 0, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/returns/show.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Request Return']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Request Return']); ?>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="<?php echo e(route('orders.index')); ?>" class="hover:text-[#22c55e] transition-colors">Orders</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="hover:text-[#22c55e] transition-colors"><?php echo e($order->order_number); ?></a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">Request Return</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Request Return</h1>

        <form action="<?php echo e(route('returns.store', $order->order_number)); ?>" method="POST" class="bg-white rounded-xl shadow-sm p-6">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Select Item to Return</h2>
                <div class="space-y-3">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $hasReturn = \App\Models\ReturnRequest::where('order_item_id', $item->id)->exists();
                        ?>
                        <label class="flex items-center p-4 border-2 rounded-xl transition-all <?php echo e($hasReturn ? 'opacity-50 cursor-not-allowed bg-gray-50 border-gray-200' : (old('order_item_id') == $item->id ? 'border-[#22c55e] bg-green-50 cursor-pointer' : 'border-gray-200 hover:border-gray-300 cursor-pointer')); ?>">
                            <input type="radio" name="order_item_id" value="<?php echo e($item->id); ?>" <?php echo e(old('order_item_id') == $item->id ? 'checked' : ''); ?> <?php echo e($hasReturn ? 'disabled' : ''); ?> class="w-5 h-5 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                            <div class="ml-3 flex-1 flex items-center gap-4">
                                <?php if($item->product && $item->product->images->isNotEmpty()): ?>
                                    <img src="<?php echo e(Storage::url($item->product->images->first()->image)); ?>" 
                                         alt="<?php echo e($item->product_name); ?>"
                                         class="w-12 h-12 object-cover rounded-lg">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg"></div>
                                <?php endif; ?>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900"><?php echo e($item->product_name); ?></p>
                                    <p class="text-sm text-gray-500">Qty: <?php echo e($item->quantity); ?> × $<?php echo e(number_format($item->price, 2)); ?></p>
                                    <?php if($hasReturn): ?>
                                        <p class="text-xs text-red-500 font-bold mt-1">Return already requested for this item</p>
                                    <?php endif; ?>
                                </div>
                                <p class="font-semibold text-[#22c55e]">$<?php echo e(number_format($item->total, 2)); ?></p>
                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['order_item_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Reason for Return</h2>
                <div class="grid grid-cols-2 gap-3">
                    <?php $__currentLoopData = ['defective', 'wrong_item', 'not_as_described', 'damaged_in_transit', 'changed_mind', 'other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer transition-all <?php echo e(old('reason') === $reason ? 'border-[#22c55e] bg-green-50' : 'border-gray-200 hover:border-gray-300'); ?>">
                            <input type="radio" name="reason" value="<?php echo e($reason); ?>" <?php echo e(old('reason') === $reason ? 'checked' : ''); ?> class="w-4 h-4 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                            <span class="ml-2 text-sm text-gray-700"><?php echo e(str_replace('_', ' ', ucfirst($reason))); ?></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Details (Optional)</label>
                <textarea name="reason_description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" placeholder="Please provide any additional details about your return request..."><?php echo e(old('reason_description')); ?></textarea>
                <?php $__errorArgs = ['reason_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-8 border-t border-gray-100 pt-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Bank Details for Refund</h2>
                <p class="text-sm text-gray-500 mb-6 font-medium">Please provide your bank details accurately for the refund process.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Account Holder Name</label>
                        <input type="text" name="bank_account_name" value="<?php echo e(old('bank_account_name')); ?>" required 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="As per bank records">
                        <?php $__errorArgs = ['bank_account_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Account Number</label>
                        <input type="text" name="bank_account_number" value="<?php echo e(old('bank_account_number')); ?>" required 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="Enter your account number">
                        <?php $__errorArgs = ['bank_account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Bank IFSC Code</label>
                        <input type="text" name="bank_ifsc" value="<?php echo e(old('bank_ifsc')); ?>" required 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="e.g. SBIN0001234">
                        <?php $__errorArgs = ['bank_ifsc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="flex-1 py-3 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors text-center">
                    Cancel
                </a>
                <button type="submit" class="flex-1 py-3 px-6 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-colors">
                    Submit Request
                </button>
            </div>
        </form>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/returns/create.blade.php ENDPATH**/ ?>
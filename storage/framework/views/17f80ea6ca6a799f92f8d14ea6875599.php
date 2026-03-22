<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Create Coupon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Create Coupon']); ?>
    <div class="mb-6">
        <a href="<?php echo e(route('admin.coupons.index')); ?>" class="text-gray-400 hover:text-white transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Coupons
        </a>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
        <form action="<?php echo e(route('admin.coupons.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Code *</label>
                    <input type="text" name="code" value="<?php echo e(old('code')); ?>" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white font-mono focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent uppercase"
                        placeholder="SUMMER20">
                    <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Type *</label>
                    <select name="type" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <option value="percentage" <?php echo e(old('type') === 'percentage' ? 'selected' : ''); ?>>Percentage</option>
                        <option value="fixed" <?php echo e(old('type') === 'fixed' ? 'selected' : ''); ?>>Fixed Amount</option>
                    </select>
                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Value *</label>
                    <input type="number" name="value" value="<?php echo e(old('value')); ?>" step="0.01" min="0" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Minimum Order Amount</label>
                    <input type="number" name="min_order_amount" value="<?php echo e(old('min_order_amount')); ?>" step="0.01" min="0"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <?php $__errorArgs = ['min_order_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Maximum Discount</label>
                    <input type="number" name="max_discount" value="<?php echo e(old('max_discount')); ?>" step="0.01" min="0"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for no limit</p>
                    <?php $__errorArgs = ['max_discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Usage Limit</label>
                    <input type="number" name="usage_limit" value="<?php echo e(old('usage_limit')); ?>" min="1"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for unlimited</p>
                    <?php $__errorArgs = ['usage_limit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Per User Limit</label>
                    <input type="number" name="per_user_limit" value="<?php echo e(old('per_user_limit')); ?>" min="1"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for unlimited per user</p>
                    <?php $__errorArgs = ['per_user_limit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Start Date</label>
                    <input type="date" name="starts_at" value="<?php echo e(old('starts_at')); ?>"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <?php $__errorArgs = ['starts_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Expiry Date</label>
                    <input type="date" name="expires_at" value="<?php echo e(old('expires_at')); ?>"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="flex items-center mt-8">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                            class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] rounded focus:ring-[#22c55e] focus:ring-offset-0">
                        <span class="ml-2 text-sm text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                    Create Coupon
                </button>
            </div>
        </form>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/coupons/create.blade.php ENDPATH**/ ?>
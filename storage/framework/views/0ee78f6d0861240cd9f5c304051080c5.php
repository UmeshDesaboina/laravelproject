<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Customers']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Customers']); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Customers</h1>
        <p class="text-gray-400 mt-1">Manage customer accounts</p>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 mb-6">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name or email..."
                    class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
            </div>
            <div class="w-40">
                <select name="role" class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <option value="">All Roles</option>
                    <option value="customer" <?php echo e(request('role') === 'customer' ? 'selected' : ''); ?>>Customer</option>
                    <option value="admin" <?php echo e(request('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                Search
            </button>
            <?php if(request()->hasAny(['search', 'role'])): ?>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="px-4 py-2 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">
                    Clear
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#111827]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Orders</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Joined</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#374151]">
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-[#374151]/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#22c55e]/20 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-[#22c55e] font-semibold"><?php echo e(strtoupper(substr($customer->name, 0, 1))); ?></span>
                                </div>
                                <span class="text-white font-medium"><?php echo e($customer->name); ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($customer->email); ?></td>
                        <td class="px-6 py-4">
                            <?php if($customer->role === 'admin'): ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-purple-500/20 text-purple-400">Admin</span>
                            <?php else: ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-500/20 text-blue-400">Customer</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($customer->orders->count()); ?></td>
                        <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($customer->created_at->format('M d, Y')); ?></td>
                        <td class="px-6 py-4 text-right">
                            <a href="<?php echo e(route('admin.customers.show', $customer->id)); ?>" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No customers found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($customers->links()); ?>

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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>
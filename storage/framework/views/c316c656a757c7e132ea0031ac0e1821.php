<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Categories']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Categories']); ?>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-gray-400 mt-1">Manage product categories</p>
        </div>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
            Add Category
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-400">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 p-4 bg-red-500/20 border border-red-500/30 rounded-lg text-red-400">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#111827]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Parent</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Products</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Sort Order</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#374151]">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-[#374151]/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <?php if($category->image): ?>
                                    <img src="<?php echo e(Storage::url($category->image)); ?>" alt="" class="w-10 h-10 rounded-lg object-cover mr-3">
                                <?php endif; ?>
                                <div>
                                    <p class="text-white font-medium"><?php echo e($category->name); ?></p>
                                    <p class="text-gray-500 text-xs"><?php echo e($category->slug); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            <?php echo e($category->parent?->name ?? '-'); ?>

                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            <?php echo e($category->products_count); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php if($category->is_active): ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/20 text-green-400">Active</span>
                            <?php else: ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($category->sort_order ?? 0); ?></td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-[#374151]/30 transition-colors bg-[#111827]/50">
                            <td class="px-6 py-4 pl-12">
                                <div class="flex items-center">
                                    <?php if($child->image): ?>
                                        <img src="<?php echo e(Storage::url($child->image)); ?>" alt="" class="w-8 h-8 rounded-lg object-cover mr-3">
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-white font-medium"><?php echo e($child->name); ?></p>
                                        <p class="text-gray-500 text-xs"><?php echo e($child->slug); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($category->name); ?></td>
                            <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($child->products_count); ?></td>
                            <td class="px-6 py-4">
                                <?php if($child->is_active): ?>
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/20 text-green-400">Active</span>
                                <?php else: ?>
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm"><?php echo e($child->sort_order ?? 0); ?></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="<?php echo e(route('admin.categories.edit', $child->id)); ?>" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('admin.categories.destroy', $child->id)); ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No categories found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($categories->links()); ?>

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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>
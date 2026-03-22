<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Products']); ?>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Products</h1>
            <p class="text-gray-400 mt-1">Manage your product inventory</p>
        </div>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="flex items-center px-5 py-2.5 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-all duration-200 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Product
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg">
            <p class="text-green-400"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] shadow-xl overflow-hidden">
        <div class="p-6 border-b border-[#374151]">
            <form method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..." class="w-full px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                </div>
                <div class="w-48">
                    <select name="category" class="w-full px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="w-40">
                    <select name="status" class="w-full px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#111827]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#374151]">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-[#374151]/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <?php if($product->images->first()): ?>
                                        <img src="<?php echo e($product->images->first()->url); ?>" alt="<?php echo e($product->name); ?>" class="w-12 h-12 rounded-lg object-cover mr-4">
                                    <?php else: ?>
                                        <div class="w-12 h-12 rounded-lg bg-[#374151] flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-white font-medium"><?php echo e($product->name); ?></p>
                                        <p class="text-gray-500 text-sm">SKU: <?php echo e($product->sku); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-300"><?php echo e($product->category->name ?? 'N/A'); ?></td>
                            <td class="px-6 py-4">
                                <span class="text-[#22c55e] font-semibold">$<?php echo e(number_format($product->price, 2)); ?></span>
                                <?php if($product->compare_price): ?>
                                    <span class="text-gray-500 text-sm line-through ml-2">$<?php echo e(number_format($product->compare_price, 2)); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="<?php echo e($product->quantity <= $product->low_stock_threshold ? 'text-red-400' : 'text-gray-300'); ?>">
                                    <?php echo e($product->quantity); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="<?php echo e(route('admin.products.toggle-status', $product)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors <?php echo e($product->is_active ? 'bg-[#22c55e]' : 'bg-[#374151]'); ?>">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform <?php echo e($product->is_active ? 'translate-x-6' : 'translate-x-1'); ?>"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($product->is_featured): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">Featured</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-500/20 text-gray-400">No</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="p-2 text-gray-400 hover:text-[#22c55e] hover:bg-[#22c55e]/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete(<?php echo e($product->id); ?>)" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-gray-400">No products found</p>
                                <a href="<?php echo e(route('admin.products.create')); ?>" class="text-[#22c55e] hover:underline mt-2 inline-block">Add your first product</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($products->hasPages()): ?>
            <div class="px-6 py-4 border-t border-[#374151]">
                <?php echo e($products->appends(request()->query())->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <form id="delete-form" method="POST" class="hidden">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

    <div id="delete-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-500/20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Delete Product</h3>
                <p class="text-gray-400 mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
                <div class="flex space-x-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">Cancel</button>
                    <button onclick="document.getElementById('delete-form').submit()" class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
    function confirmDelete(productId) {
        document.getElementById('delete-form').action = '/admin/products/' + productId;
        document.getElementById('delete-modal').classList.remove('hidden');
        document.getElementById('delete-modal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.getElementById('delete-modal').classList.remove('flex');
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
<?php endif; ?>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
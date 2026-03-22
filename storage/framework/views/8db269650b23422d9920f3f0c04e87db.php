<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Shop']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Shop']); ?>
    <div class="bg-gray-900 py-16 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
                <?php echo e($selectedCategory ? $selectedCategory->name : 'All Collections'); ?>

            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                Discover professional-grade gear designed for champions.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <aside class="lg:w-72 flex-shrink-0">
                <div class="glass rounded-3xl p-8 sticky top-28 border border-gray-100">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-bold text-gray-900">Filters</h2>
                        <?php if(request()->hasAny(['category', 'min_price', 'max_price', 'search'])): ?>
                            <a href="<?php echo e(route('shop.index')); ?>" class="text-xs font-bold text-red-500 hover:text-red-600 uppercase tracking-widest">Clear All</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-10">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Categories</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="<?php echo e(route('shop.index')); ?>" 
                                   class="flex items-center justify-between group transition-all">
                                    <span class="text-sm font-bold <?php echo e(!$selectedCategory ? 'text-primary' : 'text-gray-500 group-hover:text-primary'); ?>">All Gear</span>
                                    <span class="text-[10px] font-black px-2 py-0.5 rounded-full <?php echo e(!$selectedCategory ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-400'); ?>"><?php echo e(\App\Models\Product::active()->published()->count()); ?></span>
                                </a>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('shop.index', ['category' => $category->slug])); ?>" 
                                       class="flex items-center justify-between group transition-all">
                                        <span class="text-sm font-bold <?php echo e($selectedCategory?->id === $category->id ? 'text-primary' : 'text-gray-500 group-hover:text-primary'); ?>"><?php echo e($category->name); ?></span>
                                        <span class="text-[10px] font-black px-2 py-0.5 rounded-full <?php echo e($selectedCategory?->id === $category->id ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-400'); ?>"><?php echo e($category->products()->active()->published()->count()); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div class="pt-8 border-t border-gray-100">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Price Range</h3>
                        <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                            <?php if(request('category')): ?>
                                <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                            <?php endif; ?>
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                    <input type="number" name="min_price" value="<?php echo e(request('min_price')); ?>" placeholder="0" 
                                           class="w-full pl-6 pr-3 py-2 bg-gray-50 border-transparent rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                </div>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                    <input type="number" name="max_price" value="<?php echo e(request('max_price')); ?>" placeholder="1k+" 
                                           class="w-full pl-6 pr-3 py-2 bg-gray-50 border-transparent rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                </div>
                            </div>
                            <button type="submit" class="w-full btn-primary !py-2.5 !text-sm">Apply Filter</button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                    <p class="text-gray-500 text-sm font-medium">
                        Showing <span class="text-gray-900 font-bold"><?php echo e($products->firstItem() ?? 0); ?>-<?php echo e($products->lastItem() ?? 0); ?></span> of <span class="text-gray-900 font-bold"><?php echo e($products->total()); ?></span> products
                    </p>
                    <div class="flex items-center gap-4">
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest">Sort By:</label>
                        <select onchange="window.location.href=this.value" class="bg-white border border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                            <?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => $key])); ?>" <?php echo e($sort === $key ? 'selected' : ''); ?>><?php echo e($option[0]); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="group">
                            <div class="relative aspect-[4/5] rounded-3xl overflow-hidden bg-gray-100 mb-6 card-hover">
                                <?php if($product->images->isNotEmpty()): ?>
                                    <img src="<?php echo e($product->images->first()->url); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                                    <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-gray-900 hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-gray-900 hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300 delay-75">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <?php if($product->compare_price && $product->compare_price > $product->price): ?>
                                    <span class="absolute top-4 left-4 px-4 py-1.5 bg-red-500 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">Sale</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="text-center">
                                <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="block text-lg font-bold text-gray-900 hover:text-primary transition-colors mb-2 line-clamp-1"><?php echo e($product->name); ?></a>
                                <div class="flex items-center justify-center gap-3">
                                    <span class="text-xl font-black text-primary">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <?php if($product->compare_price): ?>
                                        <span class="text-sm text-gray-400 line-through font-bold">$<?php echo e(number_format($product->compare_price, 2)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full py-24 text-center glass rounded-3xl border-dashed border-2 border-gray-200">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-500 mb-8">Try adjusting your filters or search terms.</p>
                            <a href="<?php echo e(route('shop.index')); ?>" class="btn-primary">Clear All Filters</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-16">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>

        <?php if($recentlyViewedProducts->isNotEmpty()): ?>
            <div class="mt-32 pt-24 border-t border-gray-100">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Recently Viewed</h2>
                        <p class="text-gray-500 font-medium mt-2">Pick up where you left off.</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <?php $__currentLoopData = $recentlyViewedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('shop.show', $recent->slug)); ?>" class="group">
                            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100 mb-4 card-hover">
                                <?php if($recent->images->isNotEmpty()): ?>
                                    <img src="<?php echo e($recent->images->first()->url); ?>" alt="<?php echo e($recent->name); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <?php endif; ?>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-primary transition-colors truncate"><?php echo e($recent->name); ?></h3>
                            <p class="text-primary font-black mt-1">$<?php echo e(number_format($recent->price, 2)); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/shop/index.blade.php ENDPATH**/ ?>
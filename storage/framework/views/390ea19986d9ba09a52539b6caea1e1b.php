<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => ''.e($product->name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($product->name).'']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="/" class="hover:text-[#22c55e] transition-colors">Home</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="<?php echo e(route('shop.index')); ?>" class="hover:text-[#22c55e] transition-colors">Shop</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900"><?php echo e($product->name); ?></span>
        </nav>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-8">
                <div class="space-y-4">
                    <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100" x-data="{ activeImage: 0 }">
                        <?php if($product->images->count() > 1): ?>
                            <div class="absolute inset-0">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e($image->url); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 <?php echo e($index === 0 ? 'opacity-100' : 'opacity-0'); ?>"
                                         x-show="$store.image.active === <?php echo e($index); ?>"
                                         x-transition>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button @click="$store.image.active = <?php echo e($index); ?>" 
                                            class="w-3 h-3 rounded-full transition-colors <?php echo e($index === 0 ? 'bg-[#22c55e]' : 'bg-white/60 hover:bg-white'); ?>">
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php elseif($product->images->isNotEmpty()): ?>
                            <img src="<?php echo e($product->images->first()->url); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($product->compare_price && $product->compare_price > $product->price): ?>
                            <span class="absolute top-4 left-4 px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg">
                                Save <?php echo e(round((($product->compare_price - $product->price) / $product->compare_price) * 100)); ?>%
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if($product->images->count() > 1): ?>
                        <div class="grid grid-cols-4 gap-3">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button @click="$store.image.active = <?php echo e($index); ?>" 
                                        class="aspect-square rounded-lg overflow-hidden border-2 transition-all <?php echo e($index === 0 ? 'border-[#22c55e]' : 'border-transparent hover:border-gray-300'); ?>">
                                    <img src="<?php echo e($image->url); ?>" alt="Thumbnail" class="w-full h-full object-cover">
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col">
                    <div class="flex-1">
                        <p class="text-sm text-[#22c55e] font-medium mb-2"><?php echo e($product->category->name ?? 'Uncategorized'); ?></p>
                        <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php echo e($product->name); ?></h1>
                        
                        <div class="flex items-center mb-6">
                            <div class="flex text-yellow-400">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-5 h-5 <?php echo e($i <= 4 ? 'fill-current' : 'text-gray-300'); ?>" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="ml-2 text-sm text-gray-500">(<?php echo e(rand(10, 100)); ?> reviews)</span>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-baseline gap-3">
                                <span class="text-4xl font-bold text-[#22c55e]">$<?php echo e(number_format($product->price, 2)); ?></span>
                                <?php if($product->compare_price): ?>
                                    <span class="text-xl text-gray-400 line-through">$<?php echo e(number_format($product->compare_price, 2)); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if($product->compare_price): ?>
                                <p class="text-sm text-red-500 mt-1">You save $<?php echo e(number_format($product->compare_price - $product->price, 2)); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if($product->short_description): ?>
                            <p class="text-gray-600 mb-6"><?php echo e($product->short_description); ?></p>
                        <?php endif; ?>

                        <div class="border-t border-b border-gray-200 py-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-600">SKU:</span>
                                <span class="font-medium text-gray-900"><?php echo e($product->sku); ?></span>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-600">Availability:</span>
                                <?php if($product->quantity > 0): ?>
                                    <span class="flex items-center text-green-600">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        In Stock (<?php echo e($product->quantity); ?> available)
                                    </span>
                                <?php else: ?>
                                    <span class="flex items-center text-red-500">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Out of Stock
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Delivery:</span>
                                <span class="font-medium text-gray-900">
                                    <?php if($product->delivery_type === 'free'): ?>
                                        <span class="text-green-600">Free Delivery</span>
                                    <?php else: ?>
                                        $<?php echo e(number_format($product->delivery_charge, 2)); ?> Delivery
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <form id="add-to-cart-form" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" class="px-4 py-3 text-gray-600 hover:text-[#22c55e] transition-colors" onclick="updateQuantity(-1)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo e($product->quantity); ?>" class="w-16 text-center border-0 focus:outline-none focus:ring-0 text-gray-900 font-medium">
                                <button type="button" class="px-4 py-3 text-gray-600 hover:text-[#22c55e] transition-colors" onclick="updateQuantity(1)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" id="add-to-cart-btn" <?php echo e($product->quantity <= 0 ? 'disabled' : ''); ?> 
                                    class="flex-1 py-3 px-6 bg-[#22c55e] hover:bg-[#16a34a] disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-semibold rounded-lg transition-colors shadow-lg shadow-[#22c55e]/25">
                                <?php echo e($product->quantity > 0 ? 'Add to Cart' : 'Out of Stock'); ?>

                            </button>
                            <button type="button" id="wishlist-btn" onclick="toggleWishlist(<?php echo e($product->id); ?>)" class="p-3 border-2 rounded-lg transition-colors <?php echo e($isInWishlist ? 'border-red-500 text-red-500 bg-red-50' : 'border-gray-300 text-gray-600 hover:border-red-500 hover:text-red-500'); ?>">
                                <svg class="w-6 h-6" fill="<?php echo e($isInWishlist ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <a href="<?php echo e(route('cart.index')); ?>" id="view-cart-btn" class="hidden w-full py-3 px-6 border-2 border-[#22c55e] text-[#22c55e] hover:bg-[#22c55e] hover:text-white font-semibold rounded-lg transition-colors text-center">
                            View Cart
                        </a>
                    </form>
                </div>
            </div>

            <?php if($product->description): ?>
                <div class="border-t border-gray-200 px-6 lg:px-8 py-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                    <div class="prose prose-gray max-w-none text-gray-600">
                        <?php echo nl2br(e($product->description)); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if($relatedProducts->count() > 0): ?>
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('shop.show', $related->slug)); ?>" class="group bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300">
                            <div class="relative aspect-square overflow-hidden bg-gray-100">
                                <?php if($related->images->isNotEmpty()): ?>
                                    <img src="<?php echo e($related->images->first()->url); ?>" 
                                         alt="<?php echo e($related->name); ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-1 group-hover:text-[#22c55e] transition-colors">
                                    <?php echo e($related->name); ?>

                                </h3>
                                <span class="text-lg font-bold text-[#22c55e]">
                                    $<?php echo e(number_format($related->price, 2)); ?>

                                </span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-12 bg-white rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
            
            <div class="flex flex-col md:flex-row gap-8 mb-8 pb-8 border-b border-gray-200">
                <div class="text-center">
                    <div class="text-5xl font-bold text-[#22c55e]"><?php echo e(number_format($avgRating, 1)); ?></div>
                    <div class="flex text-yellow-400 mt-2 justify-center">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <svg class="w-5 h-5 <?php echo e($i <= round($avgRating) ? 'fill-current' : 'text-gray-300'); ?>" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-500 mt-1"><?php echo e($reviews->total()); ?> reviews</p>
                </div>
                <div class="flex-1">
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-sm text-gray-600 w-8"><?php echo e($i); ?> star</span>
                            <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-400 rounded-full" style="width: <?php echo e($reviews->total() > 0 ? (($ratingCounts[$i] ?? 0) / $reviews->total() * 100) : 0); ?>%"></div>
                            </div>
                            <span class="text-sm text-gray-500 w-8"><?php echo e($ratingCounts[$i] ?? 0); ?></span>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Write a Review</h3>
                    <form action="<?php echo e(route('reviews.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex gap-2" x-data="{ rating: 0 }">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <button type="button" @click="rating = <?php echo e($i); ?>" @mouseenter="$el.parentElement.querySelectorAll('button').forEach((btn, idx) => btn.classList.toggle('text-yellow-400', idx < <?php echo e($i); ?>))" class="text-gray-300 hover:text-yellow-400 transition-colors">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>
                                <?php endfor; ?>
                                <input type="hidden" name="rating" x-model="rating" value="0">
                            </div>
                            <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title (Optional)</label>
                            <input type="text" name="title" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Summarize your review">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Review</label>
                            <textarea name="comment" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e]" placeholder="Share your experience with this product"></textarea>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">Submit Review</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="space-y-6">
                <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="pb-6 border-b border-gray-100 last:border-0">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-gray-900"><?php echo e($review->user->name); ?></span>
                                    <?php if($review->is_verified_purchase): ?>
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Verified Purchase</span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex text-yellow-400">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <svg class="w-4 h-4 <?php echo e($i <= $review->rating ? 'fill-current' : 'text-gray-300'); ?>" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-500"><?php echo e($review->created_at->format('M d, Y')); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if($review->title): ?>
                            <h4 class="font-medium text-gray-900 mb-1"><?php echo e($review->title); ?></h4>
                        <?php endif; ?>
                        <?php if($review->comment): ?>
                            <p class="text-gray-600"><?php echo e($review->comment); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500 text-center py-8">No reviews yet. Be the first to review this product!</p>
                <?php endif; ?>
            </div>

            <?php if($reviews->hasPages()): ?>
                <div class="mt-6">
                    <?php echo e($reviews->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value) + change;
        const max = parseInt(input.max);
        if (value < 1) value = 1;
        if (value > max) value = max;
        input.value = value;
    }

    function toggleWishlist(productId) {
        const btn = document.getElementById('wishlist-btn');
        
        fetch('/wishlist/add/' + productId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (data.added) {
                    btn.classList.remove('border-gray-300', 'text-gray-600');
                    btn.classList.add('border-red-500', 'text-red-500', 'bg-red-50');
                    btn.querySelector('svg').setAttribute('fill', 'currentColor');
                    alert('Added to wishlist!');
                } else {
                    btn.classList.add('border-gray-300', 'text-gray-600');
                    btn.classList.remove('border-red-500', 'text-red-500', 'bg-red-50');
                    btn.querySelector('svg').setAttribute('fill', 'none');
                    alert('Removed from wishlist');
                }
            } else {
                if (confirm(data.message + ' Would you like to login now?')) {
                    window.location.href = '<?php echo e(route("login")); ?>';
                }
            }
        })
        .catch(error => {
            console.error('Error toggling wishlist:', error);
            alert('Failed to update wishlist. Please try again.');
        });
    }

    document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('add-to-cart-btn');
        const viewCartBtn = document.getElementById('view-cart-btn');
        const formData = new FormData(this);
        
        btn.disabled = true;
        btn.textContent = 'Adding...';
        
        fetch('/cart/add/' + formData.get('product_id'), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message || 'Added to cart successfully!');
                btn.textContent = 'Added!';
                btn.classList.remove('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                btn.classList.add('bg-green-600');
                viewCartBtn.classList.remove('hidden');
                
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                    cartCount.classList.remove('hidden');
                }
                
                setTimeout(() => {
                    btn.textContent = 'Add to Cart';
                    btn.classList.add('bg-[#22c55e]', 'hover:bg-[#16a34a]');
                    btn.classList.remove('bg-green-600');
                    btn.disabled = false;
                }, 2000);
            } else {
                btn.disabled = false;
                btn.textContent = 'Add to Cart';
                if (data.redirect) {
                    if (confirm(data.message + ' Would you like to login now?')) {
                        window.location.href = data.redirect;
                    }
                } else {
                    alert(data.message || 'Something went wrong. Please try again.');
                }
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            btn.disabled = false;
            btn.textContent = 'Add to Cart';
            alert('Failed to add to cart. Please try again.');
        });
    });
    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/shop/show.blade.php ENDPATH**/ ?>
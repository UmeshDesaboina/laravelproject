<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'My Wishlist']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Wishlist']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Wishlist</h1>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <?php if($wishlists->isEmpty()): ?>
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your wishlist is empty</h2>
                <p class="text-gray-500 mb-6">Save items you love to your wishlist and they'll be waiting for you here.</p>
                <a href="<?php echo e(route('shop.index')); ?>" class="inline-flex items-center px-6 py-3 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg transition-colors">
                    Browse Products
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $product = $wishlist->product; ?>
                    <?php if($product): ?>
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                            <div class="relative aspect-square overflow-hidden bg-gray-100">
                                <?php if($product->images->isNotEmpty()): ?>
                                    <img src="<?php echo e($product->images->first()->url); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <button type="button" onclick="removeFromWishlist(event, <?php echo e($product->id); ?>)" class="absolute top-3 right-3 p-2 bg-white/90 hover:bg-white rounded-full shadow-lg transition-colors group/remove">
                                    <svg class="w-5 h-5 text-gray-400 group-hover/remove:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-1"><?php echo e($product->category->name ?? 'Uncategorized'); ?></p>
                                <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="block">
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-[#22c55e] transition-colors">
                                        <?php echo e($product->name); ?>

                                    </h3>
                                </a>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-[#22c55e]">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <?php if($product->compare_price): ?>
                                        <span class="text-sm text-gray-400 line-through">$<?php echo e(number_format($product->compare_price, 2)); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" 
                                            onclick="addToCart(event, <?php echo e($product->id); ?>)" 
                                            <?php echo e($product->quantity <= 0 ? 'disabled' : ''); ?> 
                                            class="flex-1 py-2 px-3 bg-[#22c55e] hover:bg-[#16a34a] disabled:bg-gray-300 text-white text-sm font-medium rounded-lg transition-colors">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        window.addToCart = function(event, productId) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const btn = event.currentTarget;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Adding...';

            fetch('<?php echo e(url("/cart/add")); ?>/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: 1 })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Product added to cart!');
                    window.location.href = '<?php echo e(route("cart.index")); ?>';
                } else {
                    alert(data.message || 'Error adding to cart.');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
                btn.disabled = false;
                btn.textContent = originalText;
            });
        };

        window.removeFromWishlist = function(event, productId) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            if (!confirm('Remove this item from your wishlist?')) return;
            
            fetch('<?php echo e(url("/wishlist")); ?>/' + productId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Error removing item.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            });
        };
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/user/wishlist.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Edit Product']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Product']); ?>
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="hover:text-white transition-colors">Products</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span>Edit Product</span>
        </div>
        <h1 class="text-3xl font-bold text-white">Edit Product</h1>
    </div>

    <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Basic Information</h2>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Product Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Enter product name">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">SKU <span class="text-red-400">*</span></label>
                            <input type="text" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="e.g., PROD-001">
                            <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Category <span class="text-red-400">*</span></label>
                            <select name="category_id" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                                <option value="">Select Category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Short Description</label>
                            <textarea name="short_description" rows="2" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all resize-none" placeholder="Brief product description"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
                            <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Full Description</label>
                            <textarea name="description" rows="5" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all resize-none" placeholder="Detailed product description"><?php echo e(old('description', $product->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Pricing</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Price <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" step="0.01" min="0" required class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                            </div>
                            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Compare Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="compare_price" value="<?php echo e(old('compare_price', $product->compare_price)); ?>" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Original price">
                            </div>
                            <?php $__errorArgs = ['compare_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Cost Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="cost_price" value="<?php echo e(old('cost_price', $product->cost_price)); ?>" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Optional">
                            </div>
                            <?php $__errorArgs = ['cost_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Product Images</h2>
                    
                    <?php if($product->images->count() > 0): ?>
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group">
                                    <img src="<?php echo e($image->url); ?>" alt="Product image" class="w-full aspect-square rounded-lg object-cover <?php echo e($image->is_primary ? 'ring-2 ring-[#22c55e]' : ''); ?>">
                                    <?php if($image->is_primary): ?>
                                        <span class="absolute top-2 left-2 px-2 py-1 bg-[#22c55e] text-white text-xs rounded">Primary</span>
                                    <?php endif; ?>
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center space-x-2">
                                        <?php if(!$image->is_primary): ?>
                                            <button type="button" onclick="setPrimaryImage(<?php echo e($image->id); ?>)" class="p-2 bg-white/20 hover:bg-white/30 rounded-lg" title="Set as Primary">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" onclick="deleteImage(<?php echo e($image->id); ?>)" class="p-2 bg-red-500/80 hover:bg-red-500 rounded-lg" title="Delete">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="space-y-4">
                        <div class="flex gap-3 mb-4">
                            <button type="button" onclick="document.getElementById('image-input').click()" class="flex-1 py-3 px-4 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Upload Images
                            </button>
                            <button type="button" @click="$dispatch('open-file-manager')" class="flex-1 py-3 px-4 bg-[#1f3d5c] hover:bg-[#254a73] text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                                Select from Gallery
                            </button>
                        </div>
                        
                        <div id="image-upload-area" class="border-2 border-dashed border-[#374151] rounded-xl p-6 text-center hover:border-[#22c55e] transition-colors cursor-pointer">
                            <input type="file" name="images[]" multiple accept="image/*" id="image-input" class="hidden">
                            <svg class="w-10 h-10 mx-auto text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-400 text-sm">Drag and drop images here</p>
                            <p class="text-gray-500 text-xs mt-1">PNG, JPG, GIF up to 2MB (multiple files)</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-px bg-[#374151]"></div>
                            <span class="text-gray-500 text-sm">OR</span>
                            <div class="flex-1 h-px bg-[#374151]"></div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Add Image from URL</label>
                            <div class="flex gap-2">
                                <input type="url" id="image-url-input" placeholder="https://example.com/image.jpg" class="flex-1 px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent text-sm">
                                <button type="button" id="add-url-btn" class="px-4 py-2.5 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors text-sm">
                                    Add URL
                                </button>
                            </div>
                            <input type="hidden" name="image_urls" id="image-urls-field">
                        </div>
                    </div>
                    
                    <div id="image-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Inventory</h2>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Quantity <span class="text-red-400">*</span></label>
                            <input type="number" name="quantity" value="<?php echo e(old('quantity', $product->quantity)); ?>" min="0" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Low Stock Alert</label>
                            <input type="number" name="low_stock_threshold" value="<?php echo e(old('low_stock_threshold', $product->low_stock_threshold)); ?>" min="0" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                            <?php $__errorArgs = ['low_stock_threshold'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Delivery</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="radio" name="delivery_type" id="delivery_free" value="free" <?php echo e(old('delivery_type', $product->delivery_type ?? 'free') == 'free' ? 'checked' : ''); ?> class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] focus:ring-[#22c55e] focus:ring-offset-0">
                            <label for="delivery_free" class="ml-3 text-gray-300">Free Delivery</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="delivery_type" id="delivery_fixed" value="fixed" <?php echo e(old('delivery_type', $product->delivery_type ?? 'free') == 'fixed' ? 'checked' : ''); ?> class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] focus:ring-[#22c55e] focus:ring-offset-0">
                            <label for="delivery_fixed" class="ml-3 text-gray-300">Fixed Charge</label>
                        </div>
                        <div id="delivery-charge-field" class="<?php echo e((old('delivery_type', $product->delivery_type ?? 'free') == 'fixed') ? '' : 'hidden'); ?>">
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="delivery_charge" value="<?php echo e(old('delivery_charge', $product->delivery_charge ?? 0)); ?>" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Delivery charge">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Status</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-gray-300">Active</span>
                            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?> class="sr-only peer">
                            <div class="relative w-11 h-6 bg-[#374151] rounded-full peer peer-checked:bg-[#22c55e] transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-transform peer-checked:after:translate-x-5"></div>
                        </label>
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-gray-300">Featured</span>
                            <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?> class="sr-only peer">
                            <div class="relative w-11 h-6 bg-[#374151] rounded-full peer peer-checked:bg-[#22c55e] transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-transform peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-all duration-200">
                        Update Product
                    </button>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

    <?php $__env->startPush('scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const imageUploadArea = document.getElementById('image-upload-area');
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const imageUrlInput = document.getElementById('image-url-input');
        const addUrlBtn = document.getElementById('add-url-btn');
        const imageUrlsField = document.getElementById('image-urls-field');
        
        let uploadedUrls = [];
        let selectedFiles = [];

        window.selectFromFileManager = function(urls) {
            urls.forEach(url => {
                if (!uploadedUrls.includes(url)) {
                    addImagePreview(url, 'url');
                    uploadedUrls.push(url);
                }
            });
            imageUrlsField.value = JSON.stringify(uploadedUrls);
        };

        imageUploadArea.addEventListener('click', (e) => {
            if (e.target !== imageInput) {
                imageInput.click();
            }
        });
        
        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('border-[#22c55e]');
        });
        
        imageUploadArea.addEventListener('dragleave', (e) => {
            if (!imageUploadArea.contains(e.relatedTarget)) {
                imageUploadArea.classList.remove('border-[#22c55e]');
            }
        });
        
        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('border-[#22c55e]');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        imageInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        addUrlBtn.addEventListener('click', () => {
            const url = imageUrlInput.value.trim();
            if (!url) {
                imageUrlInput.classList.add('border-red-500');
                setTimeout(() => imageUrlInput.classList.remove('border-red-500'), 1000);
                return;
            }
            if (!isValidUrl(url)) {
                alert('Please enter a valid URL (starting with http:// or https://)');
                imageUrlInput.classList.add('border-red-500');
                setTimeout(() => imageUrlInput.classList.remove('border-red-500'), 1000);
                return;
            }
            addImagePreview(url, 'url');
            uploadedUrls.push(url);
            imageUrlsField.value = JSON.stringify(uploadedUrls);
            imageUrlInput.value = '';
        });

        imageUrlInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addUrlBtn.click();
            }
        });

        function isValidUrl(string) {
            try {
                const url = new URL(string);
                return url.protocol === 'http:' || url.protocol === 'https:';
            } catch (_) {
                return false;
            }
        }

        function addImagePreview(src, type, file = null) {
            const index = imagePreview.children.length;
            const div = document.createElement('div');
            div.className = 'relative aspect-square rounded-lg overflow-hidden bg-[#111827]';
            div.innerHTML = `
                <img src="${src}" class="w-full h-full object-cover" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'%3E%3Crect fill=\'%23374151\' width=\'100\' height=\'100\'/%3E%3Ctext x=\'50\' y=\'55\' fill=\'%239CA3AF\' text-anchor=\'middle\' font-size=\'12\'%3ENo Image%3C/text%3E%3C/svg%3E'">
                <span class="absolute top-2 left-2 px-2 py-1 ${type === 'url' ? 'bg-blue-500' : 'bg-[#22c55e]'} text-white text-xs rounded">
                    ${index === 0 ? 'Primary' : (type === 'url' ? 'URL' : '#' + (index + 1))}
                </span>
                <button type="button" class="remove-btn absolute top-2 right-2 p-1 bg-red-500/80 hover:bg-red-500 rounded-full text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            
            div.querySelector('.remove-btn').addEventListener('click', () => {
                removeImage(div, type, src, file);
            });
            
            imagePreview.appendChild(div);
        }

        function handleFiles(files) {
            Array.from(files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    selectedFiles.push(file);
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        addImagePreview(e.target.result, 'file', file);
                    };
                    reader.readAsDataURL(file);
                }
            });
            updateFileInput();
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        function removeImage(el, type, src, file = null) {
            el.remove();
            if (type === 'url') {
                uploadedUrls = uploadedUrls.filter(url => url !== src);
                imageUrlsField.value = JSON.stringify(uploadedUrls);
            } else if (file) {
                selectedFiles = selectedFiles.filter(f => f !== file);
                updateFileInput();
            }
            updateImageOrder();
        }

        function updateImageOrder() {
            const items = imagePreview.children;
            Array.from(items).forEach((item, index) => {
                const span = item.querySelector('span');
                if (span) {
                    span.textContent = index === 0 ? 'Primary' : '#' + (index + 1);
                }
            });
        }

        document.querySelectorAll('input[name="delivery_type"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                document.getElementById('delivery-charge-field').classList.toggle('hidden', e.target.value !== 'fixed');
            });
        });
    });

    function setPrimaryImage(imageId) {
        fetch(`/admin/products/images/${imageId}/primary`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        }).then(() => location.reload());
    }

    function deleteImage(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch(`/admin/products/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json'
                }
            }).then(() => location.reload());
        }
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
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>
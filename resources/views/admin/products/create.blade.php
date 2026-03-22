<x-layouts.admin title="Add Product">
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <a href="{{ route('admin.products.index') }}" class="hover:text-white transition-colors">Products</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span>Add Product</span>
        </div>
        <h1 class="text-3xl font-bold text-white">Add New Product</h1>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Basic Information</h2>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Product Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Enter product name">
                            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">SKU <span class="text-red-400">*</span></label>
                            <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="e.g., PROD-001">
                            @error('sku') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Category <span class="text-red-400">*</span></label>
                            <select name="category_id" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Short Description</label>
                            <textarea name="short_description" rows="2" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all resize-none" placeholder="Brief product description">{{ old('short_description') }}</textarea>
                            @error('short_description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Full Description</label>
                            <textarea name="description" rows="5" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all resize-none" placeholder="Detailed product description">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
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
                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                            </div>
                            @error('price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Compare Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="compare_price" value="{{ old('compare_price') }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Original price">
                            </div>
                            @error('compare_price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Cost Price</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="cost_price" value="{{ old('cost_price') }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Optional">
                            </div>
                            @error('cost_price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Images</h2>
                    
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
                            <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" required class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all">
                            @error('quantity') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Low Stock Alert</label>
                            <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold', 5) }}" min="0" class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Alert when stock is low">
                            @error('low_stock_threshold') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Delivery</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="radio" name="delivery_type" id="delivery_free" value="free" {{ old('delivery_type', 'free') == 'free' ? 'checked' : '' }} class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] focus:ring-[#22c55e] focus:ring-offset-0">
                            <label for="delivery_free" class="ml-3 text-gray-300">Free Delivery</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="delivery_type" id="delivery_fixed" value="fixed" {{ old('delivery_type') == 'fixed' ? 'checked' : '' }} class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] focus:ring-[#22c55e] focus:ring-offset-0">
                            <label for="delivery_fixed" class="ml-3 text-gray-300">Fixed Charge</label>
                        </div>
                        <div id="delivery-charge-field" class="{{ old('delivery_type') == 'fixed' ? '' : 'hidden' }}">
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" name="delivery_charge" value="{{ old('delivery_charge', 0) }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all" placeholder="Delivery charge">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-white mb-6">Status</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-gray-300">Active</span>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="relative w-11 h-6 bg-[#374151] rounded-full peer peer-checked:bg-[#22c55e] transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-transform peer-checked:after:translate-x-5"></div>
                        </label>
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-gray-300">Featured</span>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="sr-only peer">
                            <div class="relative w-11 h-6 bg-[#374151] rounded-full peer peer-checked:bg-[#22c55e] transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-transform peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg transition-all duration-200">
                        Create Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
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
    </script>
    @endpush
</x-layouts.admin>

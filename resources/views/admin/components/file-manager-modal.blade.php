<div x-data="{ 
    open: false,
    selectedImages: [],
    searchQuery: '',
    loading: false,
    images: [],
    page: 1,
    lastPage: 1,
    totalImages: 0,
    async fetchImages(page = 1) {
        this.loading = true;
        try {
            const response = await fetch(`/admin/file-manager/images?page=${page}&search=${encodeURIComponent(this.searchQuery)}`);
            const data = await response.json();
            this.images = data.images;
            this.page = data.pagination.current_page;
            this.lastPage = data.pagination.last_page;
            this.totalImages = data.pagination.total;
        } catch (error) {
            console.error('Error fetching images:', error);
        }
        this.loading = false;
    },
    openModal() {
        this.open = true;
        this.searchQuery = '';
        this.page = 1;
        this.fetchImages();
    },
    toggleImage(image) {
        const index = this.selectedImages.indexOf(image.url);
        if (index > -1) {
            this.selectedImages.splice(index, 1);
        } else {
            this.selectedImages.push(image.url);
        }
    },
    isSelected(url) {
        return this.selectedImages.includes(url);
    },
    selectImages() {
        if (typeof window.selectFromFileManager === 'function') {
            window.selectFromFileManager(this.selectedImages);
        }
        this.close();
    },
    close() {
        this.open = false;
        this.selectedImages = [];
    }
}" 
@open-file-manager.window="openModal()"
x-show="open" 
x-on:keydown.escape.window="close()"
class="fixed inset-0 z-50 overflow-y-auto"
style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-black/60" @click="close()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#1f2937] rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">
            <div class="flex items-center justify-between px-6 py-4 border-b border-[#374151]">
                <h3 class="text-lg font-semibold text-white">Select Images from Gallery</h3>
                <button @click="close()" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" x-model="searchQuery" @input.debounce.300ms="fetchImages()" placeholder="Search by filename or product name..." class="w-full px-4 py-2.5 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p x-show="totalImages > 0" class="text-sm text-gray-400 mt-2">
                        <span x-text="totalImages"></span> image(s) available
                    </p>
                </div>

                <div x-show="loading" class="flex items-center justify-center py-12">
                    <svg class="animate-spin h-8 w-8 text-[#22c55e]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <div x-show="!loading && images.length === 0" class="text-center py-12 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>No images found</p>
                    <p class="text-sm mt-1">Upload images to products or add them to the storage folder to see them here</p>
                </div>

                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 max-h-80 overflow-y-auto" x-show="!loading">
                    <template x-for="image in images" :key="image.id">
                        <div @click="toggleImage(image)" :class="isSelected(image.url) ? 'ring-2 ring-[#22c55e] ring-offset-2 ring-offset-[#1f2937]' : ''" class="relative aspect-square rounded-lg overflow-hidden cursor-pointer group bg-[#111827]">
                            <img :src="image.thumb" :alt="image.product || image.filename" class="w-full h-full object-cover" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'%3E%3Crect fill=\'%23374151\' width=\'100\' height=\'100\'/%3E%3Ctext x=\'50\' y=\'55\' fill=\'%239CA3AF\' text-anchor=\'middle\' font-size=\'10\'%3EBroken%3C/text%3E%3C/svg%3E'">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <svg x-show="isSelected(image.url)" class="w-8 h-8 text-[#22c55e]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-1 truncate">
                                <span x-text="image.product || image.filename"></span>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="lastPage > 1" class="flex items-center justify-center gap-2 mt-4">
                    <button @click="fetchImages(page - 1)" :disabled="page <= 1" class="px-3 py-1 bg-[#374151] text-white rounded disabled:opacity-50 disabled:cursor-not-allowed hover:bg-[#4b5563] transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <span class="text-gray-400 text-sm">Page <span x-text="page"></span> of <span x-text="lastPage"></span></span>
                    <button @click="fetchImages(page + 1)" :disabled="page >= lastPage" class="px-3 py-1 bg-[#374151] text-white rounded disabled:opacity-50 disabled:cursor-not-allowed hover:bg-[#4b5563] transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 border-t border-[#374151] bg-[#111827]">
                <div class="text-sm text-gray-400">
                    <span x-text="selectedImages.length"></span> image(s) selected
                </div>
                <div class="flex gap-3">
                    <button @click="close()" class="px-4 py-2 bg-[#374151] hover:bg-[#4b5563] text-white font-medium rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button @click="selectImages()" :disabled="selectedImages.length === 0" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-medium rounded-lg transition-colors">
                        Select Image(s)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

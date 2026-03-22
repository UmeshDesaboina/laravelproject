<x-layouts.admin title="Categories">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-gray-400 mt-1">Manage product categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
            Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-500/20 border border-red-500/30 rounded-lg text-red-400">
            {{ session('error') }}
        </div>
    @endif

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
                @forelse($categories as $category)
                    <tr class="hover:bg-[#374151]/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="" class="w-10 h-10 rounded-lg object-cover mr-3">
                                @endif
                                <div>
                                    <p class="text-white font-medium">{{ $category->name }}</p>
                                    <p class="text-gray-500 text-xs">{{ $category->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            {{ $category->parent?->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">
                            {{ $category->products_count }}
                        </td>
                        <td class="px-6 py-4">
                            @if($category->is_active)
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/20 text-green-400">Active</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $category->sort_order ?? 0 }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @foreach($category->children as $child)
                        <tr class="hover:bg-[#374151]/30 transition-colors bg-[#111827]/50">
                            <td class="px-6 py-4 pl-12">
                                <div class="flex items-center">
                                    @if($child->image)
                                        <img src="{{ Storage::url($child->image) }}" alt="" class="w-8 h-8 rounded-lg object-cover mr-3">
                                    @endif
                                    <div>
                                        <p class="text-white font-medium">{{ $child->name }}</p>
                                        <p class="text-gray-500 text-xs">{{ $child->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $child->products_count }}</td>
                            <td class="px-6 py-4">
                                @if($child->is_active)
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/20 text-green-400">Active</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $child->sort_order ?? 0 }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.categories.edit', $child->id) }}" class="p-2 text-gray-400 hover:text-[#22c55e] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</x-layouts.admin>

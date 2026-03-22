<x-layouts.admin title="Create Coupon">
    <div class="mb-6">
        <a href="{{ route('admin.coupons.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Coupons
        </a>
    </div>

    <div class="bg-[#1f2937] rounded-xl border border-[#374151] p-6">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Code *</label>
                    <input type="text" name="code" value="{{ old('code') }}" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white font-mono focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent uppercase"
                        placeholder="SUMMER20">
                    @error('code')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Type *</label>
                    <select name="type" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                        <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                        <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    </select>
                    @error('type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Value *</label>
                    <input type="number" name="value" value="{{ old('value') }}" step="0.01" min="0" required
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    @error('value')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Minimum Order Amount</label>
                    <input type="number" name="min_order_amount" value="{{ old('min_order_amount') }}" step="0.01" min="0"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    @error('min_order_amount')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Maximum Discount</label>
                    <input type="number" name="max_discount" value="{{ old('max_discount') }}" step="0.01" min="0"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for no limit</p>
                    @error('max_discount')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Usage Limit</label>
                    <input type="number" name="usage_limit" value="{{ old('usage_limit') }}" min="1"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for unlimited</p>
                    @error('usage_limit')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Per User Limit</label>
                    <input type="number" name="per_user_limit" value="{{ old('per_user_limit') }}" min="1"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    <p class="text-gray-500 text-xs mt-1">Leave empty for unlimited per user</p>
                    @error('per_user_limit')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Start Date</label>
                    <input type="date" name="starts_at" value="{{ old('starts_at') }}"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    @error('starts_at')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Expiry Date</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                        class="w-full px-4 py-2 bg-[#111827] border border-[#374151] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                    @error('expires_at')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center mt-8">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-4 h-4 text-[#22c55e] bg-[#111827] border-[#374151] rounded focus:ring-[#22c55e] focus:ring-offset-0">
                        <span class="ml-2 text-sm text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#22c55e] hover:bg-[#16a34a] text-white font-medium rounded-lg transition-colors">
                    Create Coupon
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>

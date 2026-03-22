<?php if (isset($component)) { $__componentOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d4a66fcbe5bca4283446c4a3eb8df97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.shop','data' => ['title' => 'Checkout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.shop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Checkout']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <form id="checkout-form" action="<?php echo e(route('checkout.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-[#22c55e] text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                            Shipping Address
                        </h2>
                        
                        <!-- Address logic stays here -->
                        <?php if($addresses->count() > 0): ?>
                            <div class="mb-6">
                                <p class="text-sm text-gray-600 mb-3">Select a saved address:</p>
                                <div class="space-y-3">
                                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="flex items-start p-4 border-2 rounded-xl cursor-pointer transition-all <?php echo e(old('address_id', $addresses->where('is_default', true)->first()?->id) == $address->id ? 'border-[#22c55e] bg-green-50' : 'border-gray-200 hover:border-gray-300'); ?> saved-address-label">
                                            <input type="radio" name="address_id" value="<?php echo e($address->id); ?>" <?php echo e(old('address_id', $addresses->where('is_default', true)->first()?->id) == $address->id ? 'checked' : ''); ?> class="mt-1 w-4 h-4 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                                            <div class="ml-3 flex-1">
                                                <p class="font-medium text-gray-900"><?php echo e($address->full_name); ?></p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <?php echo e($address->address_line_1); ?>

                                                    <?php if($address->address_line_2): ?>
                                                        , <?php echo e($address->address_line_2); ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <?php echo e($address->city); ?>, <?php echo e($address->state); ?> <?php echo e($address->postal_code); ?>

                                                </p>
                                                <p class="text-sm text-gray-600 mt-1">Phone: <?php echo e($address->phone); ?></p>
                                                <?php if($address->is_default): ?>
                                                    <span class="inline-block mt-2 px-2 py-0.5 bg-[#22c55e] text-white text-xs rounded">Default</span>
                                                <?php endif; ?>
                                            </div>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or add new address</span>
                                </div>
                            </div>

                            <div id="new-address-form" class="mt-6 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="full_name" value="<?php echo e(old('full_name')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="John Doe">
                                        <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="+1 234 567 8900">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line_1" value="<?php echo e(old('address_line_1')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['address_line_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="123 Main Street">
                                    <?php $__errorArgs = ['address_line_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line_2" value="<?php echo e(old('address_line_2')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" placeholder="Apartment, suite, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" value="<?php echo e(old('city')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="New York">
                                        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" value="<?php echo e(old('state')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="NY">
                                        <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input type="text" name="postal_code" value="<?php echo e(old('postal_code')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="10001">
                                        <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select name="country" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                                        <option value="US" <?php echo e(old('country', 'US') == 'US' ? 'selected' : ''); ?>>United States</option>
                                        <option value="CA" <?php echo e(old('country') == 'CA' ? 'selected' : ''); ?>>Canada</option>
                                        <option value="UK" <?php echo e(old('country') == 'UK' ? 'selected' : ''); ?>>United Kingdom</option>
                                        <option value="IN" <?php echo e(old('country') == 'IN' ? 'selected' : ''); ?>>India</option>
                                    </select>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="full_name" value="<?php echo e(old('full_name')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="John Doe">
                                        <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="+1 234 567 8900">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line_1" value="<?php echo e(old('address_line_1')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['address_line_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="123 Main Street">
                                    <?php $__errorArgs = ['address_line_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line_2" value="<?php echo e(old('address_line_2')); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" placeholder="Apartment, suite, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" value="<?php echo e(old('city')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="New York">
                                        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" value="<?php echo e(old('state')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="NY">
                                        <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input type="text" name="postal_code" value="<?php echo e(old('postal_code')); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="10001">
                                        <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select name="country" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent">
                                        <option value="US" <?php echo e(old('country', 'US') == 'US' ? 'selected' : ''); ?>>United States</option>
                                        <option value="CA" <?php echo e(old('country') == 'CA' ? 'selected' : ''); ?>>Canada</option>
                                        <option value="UK" <?php echo e(old('country') == 'UK' ? 'selected' : ''); ?>>United Kingdom</option>
                                        <option value="IN" <?php echo e(old('country') == 'IN' ? 'selected' : ''); ?>>India</option>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="w-8 h-8 bg-[#22c55e] text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                            Payment Method
                        </h2>

                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 border-[#22c55e] bg-green-50 rounded-xl cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-[#22c55e] border-gray-300 focus:ring-[#22c55e]">
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">Cash on Delivery</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1 ml-9">Pay when you receive your order</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 max-h-[400px] overflow-y-auto mb-6">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 last:border-0">
                                <div class="relative">
                                    <?php if($item['product']->images->isNotEmpty()): ?>
                                        <img src="<?php echo e($item['product']->images->first()->url); ?>" 
                                             alt="<?php echo e($item['product']->name); ?>"
                                             class="w-16 h-16 object-cover rounded-lg">
                                    <?php else: ?>
                                        <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <span class="absolute -top-2 -right-2 w-5 h-5 bg-[#22c55e] text-white text-xs font-bold rounded-full flex items-center justify-center">
                                        <?php echo e($item['quantity']); ?>

                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 line-clamp-1"><?php echo e($item['product']->name); ?></p>
                                    <p class="text-xs text-gray-500">SKU: <?php echo e($item['product']->sku); ?></p>
                                </div>
                                <p class="text-sm font-semibold text-gray-900">$<?php echo e(number_format($item['item_total'], 2)); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <div class="flex gap-2 mb-4">
                            <input type="text" id="coupon-code" name="code" placeholder="Coupon code" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent" <?php echo e(session('coupon') ? 'value=' . session('coupon.code') : ''); ?>>
                            <button type="button" id="coupon-btn" onclick="window.applyCoupon(event)" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                                <?php echo e(session('coupon') ? 'Remove' : 'Apply'); ?>

                            </button>
                        </div>
                        
                        <?php if($availableCoupons->count() > 0): ?>
                            <div class="space-y-2">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Available Coupons</p>
                                <div class="grid grid-cols-1 gap-2">
                                    <?php $__currentLoopData = $availableCoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center justify-between p-2 border border-dashed border-gray-300 rounded-lg bg-gray-50 group hover:border-[#22c55e] transition-colors">
                                            <div>
                                                <p class="text-sm font-bold text-gray-900"><?php echo e($coupon->code); ?></p>
                                                <p class="text-xs text-gray-500">
                                                    <?php if($coupon->type === 'percentage'): ?>
                                                        <?php echo e((int)$coupon->value); ?>% off
                                                    <?php else: ?>
                                                        $<?php echo e(number_format($coupon->value, 2)); ?> off
                                                    <?php endif; ?>
                                                    <?php if($coupon->min_order_amount > 0): ?>
                                                        on orders over $<?php echo e(number_format($coupon->min_order_amount, 2)); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <button type="button" onclick="window.copyAndApplyCoupon('<?php echo e($coupon->code); ?>')" class="text-xs font-semibold text-[#22c55e] hover:text-[#16a34a] py-1 px-2 border border-[#22c55e] rounded hover:bg-green-50 transition-colors">
                                                Apply
                                            </button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <p id="coupon-message" class="text-sm mt-2 hidden"></p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">$<?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium text-gray-900">
                                <?php if($totalDelivery > 0): ?>
                                    $<?php echo e(number_format($totalDelivery, 2)); ?>

                                <?php else: ?>
                                    <span class="text-green-600">Free</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if($discount > 0): ?>
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-medium">-$<?php echo e(number_format($discount, 2)); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-medium text-gray-900">$0.00</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t-2 border-[#22c55e]">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-[#22c55e]">$<?php echo e(number_format($total, 2)); ?></span>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('checkout-form').submit()" class="w-full mt-6 py-4 px-6 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg shadow-[#22c55e]/25 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Place Order
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        By placing your order, you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>
            </div>
        </div>
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

<?php $__env->startPush('scripts'); ?>
<script>
        // Update label styles when radio buttons change
        document.querySelectorAll('input[name="address_id"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                document.querySelectorAll('.saved-address-label').forEach(label => {
                    label.classList.remove('border-[#22c55e]', 'bg-green-50');
                    label.classList.add('border-gray-200');
                });
                if (e.target.checked) {
                    e.target.closest('label').classList.add('border-[#22c55e]', 'bg-green-50');
                    e.target.closest('label').classList.remove('border-gray-200');
                    
                    // Clear new address fields when selecting a saved address to avoid validation confusion
                    document.querySelectorAll('#new-address-form input').forEach(input => {
                        input.value = '';
                    });
                }
            });
        });

    const isApplied = <?php echo e(session('coupon') ? 'true' : 'false'); ?>;

    window.copyAndApplyCoupon = function(code) {
        const couponCodeInput = document.getElementById('coupon-code');
        if (couponCodeInput) {
            couponCodeInput.value = code;
            window.applyCoupon();
        }
    };

    window.applyCoupon = async function(event) {
        console.log('applyCoupon called');
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }

        const couponBtn = document.getElementById('coupon-btn');
        const couponCodeInput = document.getElementById('coupon-code');
        const couponMessage = document.getElementById('coupon-message');

        if (!couponCodeInput) {
            console.error('Coupon code input not found');
            return;
        }

        const code = couponCodeInput.value.trim();

        if (isApplied) {
            console.log('Removing coupon...');
            if (couponBtn) {
                couponBtn.disabled = true;
                couponBtn.textContent = 'Removing...';
            }
            try {
                const response = await fetch('<?php echo e(route("coupon.remove")); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to remove coupon.');
                    if (couponBtn) {
                        couponBtn.disabled = false;
                        couponBtn.textContent = 'Remove';
                    }
                }
            } catch (error) {
                console.error('Coupon remove error:', error);
                alert('Something went wrong while removing the coupon.');
                if (couponBtn) {
                    couponBtn.disabled = false;
                    couponBtn.textContent = 'Remove';
                }
            }
            return;
        }

        if (!code) {
            if (couponMessage) {
                couponMessage.textContent = 'Please enter a coupon code.';
                couponMessage.className = 'text-sm mt-2 text-red-600';
                couponMessage.classList.remove('hidden');
            }
            return;
        }

        console.log('Applying coupon:', code);
        if (couponBtn) {
            couponBtn.disabled = true;
            couponBtn.textContent = 'Applying...';
        }

        try {
            const response = await fetch('<?php echo e(route("coupon.apply")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ code })
            });

            const data = await response.json();
            console.log('Coupon response:', data);
            
            if (data.success) {
                alert(data.message || 'Coupon applied successfully!');
                location.reload();
            } else {
                alert(data.message || 'Failed to apply coupon.');
                if (couponMessage) {
                    couponMessage.textContent = data.message;
                    couponMessage.className = 'text-sm mt-2 text-red-600';
                    couponMessage.classList.remove('hidden');
                }
                if (couponBtn) {
                    couponBtn.disabled = false;
                    couponBtn.textContent = 'Apply';
                }
            }
        } catch (error) {
            console.error('Coupon error:', error);
            alert('Something went wrong while applying the coupon. Please try again.');
            if (couponBtn) {
                couponBtn.disabled = false;
                couponBtn.textContent = 'Apply';
            }
        }
    };

    // Handle enter key on coupon input
    document.addEventListener('DOMContentLoaded', () => {
        const couponCodeInput = document.getElementById('coupon-code');
        if (couponCodeInput) {
            couponCodeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    window.applyCoupon();
                }
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/checkout/index.blade.php ENDPATH**/ ?>
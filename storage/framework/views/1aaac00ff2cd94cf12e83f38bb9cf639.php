<?php if (isset($component)) { $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.auth','data' => ['title' => 'Register - FightWisdom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Register - FightWisdom']); ?>
    <div class="bg-[#1f2937] rounded-2xl shadow-2xl p-8 border border-[#374151]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
            <p class="text-gray-400">Join us today</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                <ul class="text-red-400 text-sm space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="<?php echo e(old('name')); ?>"
                       required 
                       autofocus
                       class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all duration-200"
                       placeholder="John Doe">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?php echo e(old('email')); ?>"
                       required
                       class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all duration-200"
                       placeholder="you@example.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all duration-200"
                       placeholder="Minimum 8 characters">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required
                       class="w-full px-4 py-3 bg-[#111827] border border-[#374151] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#22c55e] focus:border-transparent transition-all duration-200"
                       placeholder="Confirm your password">
            </div>

            <button type="submit" 
                    class="w-full py-3 px-4 bg-[#22c55e] hover:bg-[#16a34a] text-white font-semibold rounded-lg shadow-lg hover:shadow-[#22c55e]/20 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400">
                Already have an account? 
                <a href="<?php echo e(route('login')); ?>" class="text-[#22c55e] hover:text-[#16a34a] font-medium transition-colors">
                    Sign In
                </a>
            </p>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $attributes = $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $component = $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/auth/register.blade.php ENDPATH**/ ?>
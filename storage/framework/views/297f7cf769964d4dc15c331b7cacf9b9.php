<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Laravel'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-[#111827] min-h-screen flex items-center justify-center overflow-hidden">
    <div class="w-full max-w-md mx-4">
        <?php echo e($slot); ?>

    </div>
</body>
</html>
<?php /**PATH C:\Users\umesh\fightwisdoml\resources\views/components/layouts/auth.blade.php ENDPATH**/ ?>
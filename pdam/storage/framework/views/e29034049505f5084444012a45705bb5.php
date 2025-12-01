<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'EcoWater')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="text-2xl font-bold text-sky-600 dark:text-sky-400">
                        💧 EcoWater
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                        <?php echo e(__('messages.home')); ?>

                    </a>
                    <a href="<?php echo e(route('about')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                        <?php echo e(__('messages.about')); ?>

                    </a>
                    <a href="<?php echo e(route('tariff')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                        <?php echo e(__('messages.tariff')); ?>

                    </a>
                    <a href="<?php echo e(route('bill-simulator')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                        <?php echo e(__('messages.bill_simulator')); ?>

                    </a>
                    <a href="<?php echo e(route('contact')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                        <?php echo e(__('messages.contact')); ?>

                    </a>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div class="flex items-center space-x-2 border-r pr-4 dark:border-gray-700">
                        <a href="<?php echo e(route('locale.set', 'en')); ?>" 
                           class="px-3 py-1 rounded <?php echo e(app()->getLocale() == 'en' ? 'bg-sky-100 text-sky-600 dark:bg-sky-900 dark:text-sky-300' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                            🇬🇧 EN
                        </a>
                        <a href="<?php echo e(route('locale.set', 'id')); ?>" 
                           class="px-3 py-1 rounded <?php echo e(app()->getLocale() == 'id' ? 'bg-sky-100 text-sky-600 dark:bg-sky-900 dark:text-sky-300' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                            🇮🇩 ID
                        </a>
                    </div>

                    <!-- Auth Links -->
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                            <?php echo e(__('messages.dashboard')); ?>

                        </a>
                        <?php if(auth()->user()->is_admin): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 px-3 py-2 text-sm font-medium">
                                <?php echo e(__('messages.admin_panel')); ?>

                            </a>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 text-sm font-medium">
                                <?php echo e(__('messages.logout')); ?>

                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                            <?php echo e(__('messages.login')); ?>

                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="btn-primary">
                            <?php echo e(__('messages.register')); ?>

                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="mobile-menu-button text-gray-700 dark:text-gray-300 hover:text-sky-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded"><?php echo e(__('messages.home')); ?></a>
                <a href="<?php echo e(route('about')); ?>" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded"><?php echo e(__('messages.about')); ?></a>
                <a href="<?php echo e(route('tariff')); ?>" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded"><?php echo e(__('messages.tariff')); ?></a>
                <a href="<?php echo e(route('bill-simulator')); ?>" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded"><?php echo e(__('messages.bill_simulator')); ?></a>
                <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded"><?php echo e(__('messages.contact')); ?></a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded fade-in-up" role="alert">
                <p class="font-medium"><?php echo e(session('success')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded fade-in-up" role="alert">
                <p class="font-medium"><?php echo e(session('error')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded fade-in-up" role="alert">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="py-12">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">💧 EcoWater</h3>
                    <p class="text-gray-400"><?php echo e(__('pages.about_description')); ?></p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4"><?php echo e(__('messages.contact')); ?></h4>
                    <p class="text-gray-400">Email: info@ecowater.local</p>
                    <p class="text-gray-400">Phone: +62 123 456 7890</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('tariff')); ?>" class="text-gray-400 hover:text-white"><?php echo e(__('messages.tariff')); ?></a></li>
                        <li><a href="<?php echo e(route('bill-simulator')); ?>" class="text-gray-400 hover:text-white"><?php echo e(__('messages.bill_simulator')); ?></a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-gray-400 hover:text-white"><?php echo e(__('messages.contact')); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo e(date('Y')); ?> EcoWater. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle script -->
    <script>
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/layouts/app.blade.php ENDPATH**/ ?>
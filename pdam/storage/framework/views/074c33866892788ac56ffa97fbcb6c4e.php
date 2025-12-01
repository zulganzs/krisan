

<?php $__env->startSection('title', __('messages.bill_simulator')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8"><?php echo e(__('messages.bill_simulator')); ?></h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <div class="card">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6"><?php echo e(__('messages.calculate')); ?></h2>
            
            <form action="<?php echo e(route('bill-simulator.calculate')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <?php echo e(__('messages.previous_reading')); ?> (m³)
                    </label>
                    <input type="number" 
                           name="previous_reading" 
                           step="0.01" 
                           value="<?php echo e(old('previous_reading', $previous_reading ?? '')); ?>" 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" 
                           required>
                    <?php $__errorArgs = ['previous_reading'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <?php echo e(__('messages.current_reading')); ?> (m³)
                    </label>
                    <input type="number" 
                           name="current_reading" 
                           step="0.01" 
                           value="<?php echo e(old('current_reading', $current_reading ?? '')); ?>" 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" 
                           required>
                    <?php $__errorArgs = ['current_reading'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <?php echo e(__('messages.admin_fee')); ?> (Rp)
                    </label>
                    <input type="number" 
                           name="admin_fee" 
                           value="<?php echo e(old('admin_fee', 5000)); ?>" 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white">
                </div>

                <button type="submit" class="btn-primary w-full">
                    <?php echo e(__('messages.calculate')); ?>

                </button>
            </form>
        </div>

        <!-- Calculation Result -->
        <div class="card <?php echo e(isset($result) ? 'bg-sky-50 dark:bg-sky-900/30 border-2 border-sky-400' : 'bg-gray-100 dark:bg-gray-800'); ?>">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6"><?php echo e(__('messages.calculation_result')); ?></h2>
            
            <?php if(isset($result)): ?>
                <!-- ARITHMETIC RESULT: Display calculation breakdown -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700">
                        <span class="text-gray-700 dark:text-gray-300"><?php echo e(__('messages.usage')); ?>:</span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($result['usage'], 2)); ?> m³</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700">
                        <span class="text-gray-700 dark:text-gray-300"><?php echo e(__('messages.rate_applied')); ?>:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">Rp <?php echo e(number_format($result['rate'], 0, ',', '.')); ?>/m³</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700">
                        <span class="text-gray-700 dark:text-gray-300"><?php echo e(__('messages.base_cost')); ?>:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">Rp <?php echo e(number_format($result['base_cost'], 0, ',', '.')); ?></span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700">
                        <span class="text-gray-700 dark:text-gray-300"><?php echo e(__('messages.admin_fee')); ?>:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">Rp <?php echo e(number_format($result['admin_fee'], 0, ',', '.')); ?></span>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t-2 border-sky-400">
                        <span class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e(__('messages.total_cost')); ?>:</span>
                        <span class="text-2xl font-bold text-sky-600 dark:text-sky-400">Rp <?php echo e(number_format($result['total_cost'], 0, ',', '.')); ?></span>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-white dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong><?php echo e(__('messages.formula')); ?>:</strong> (<?php echo e(number_format($result['usage'], 2)); ?> m³ × Rp <?php echo e(number_format($result['rate'], 0, ',', '.')); ?>) + Rp <?php echo e(number_format($result['admin_fee'], 0, ',', '.')); ?>

                    </p>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🧮</div>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo e(__('messages.enter_readings')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- How it works -->
    <div class="card mt-8">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4"><?php echo e(__('messages.how_it_works')); ?></h3>
        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
            <li>✅ <?php echo e(__('messages.tier_1_desc')); ?></li>
            <li>✅ <?php echo e(__('messages.tier_2_desc')); ?></li>
            <li>✅ <?php echo e(__('messages.tier_3_desc')); ?></li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/bill-simulator.blade.php ENDPATH**/ ?>
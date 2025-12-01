

<?php $__env->startSection('title', __('messages.tariff')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8"><?php echo e(__('messages.tariff')); ?></h1>
    
    <div class="card">
        <p class="text-gray-700 dark:text-gray-300 mb-6">
            <?php echo e(__('messages.tariff_intro')); ?>

        </p>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo e(__('messages.tier_name')); ?></th>
                        <th><?php echo e(__('messages.usage_range')); ?></th>
                        <th><?php echo e(__('messages.price_per_m3')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tariff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="font-semibold text-blue-600 dark:text-blue-400"><?php echo e($tariff->tier_name); ?></td>
                            <td>
                                <?php echo e(number_format($tariff->min_usage, 0)); ?> - 
                                <?php echo e($tariff->max_usage ? number_format($tariff->max_usage, 0) : '∞'); ?> m³
                            </td>
                            <td class="font-semibold">Rp <?php echo e(number_format($tariff->price_per_m3, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong>Note:</strong> <?php echo e(__('messages.tariff_note')); ?>

            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/tariff.blade.php ENDPATH**/ ?>
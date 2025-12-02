

<?php $__env->startSection('title', __('messages.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8"><?php echo e(__('messages.welcome')); ?>, <?php echo e($user->name); ?>!</h1>
    
    <!-- Announcements -->
    <!-- Announcements -->
    <?php if(isset($announcements) && $announcements->count() > 0): ?>
        <div class="mb-8 space-y-6">
            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 border-l-4 border-sky-500 shadow-md rounded-r-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <svg class="h-6 w-6 text-sky-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                <?php echo e($announcement->title); ?>

                            </h3>
                        </div>
                        <div class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
                            <?php echo e($announcement->content); ?>

                        </div>
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            Posted on <?php echo e($announcement->created_at->format('d M Y')); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="mb-8 bg-gray-100 dark:bg-gray-800 rounded-lg p-6 flex items-center justify-center min-h-[150px] shadow-inner">
            <p class="text-gray-500 dark:text-gray-400 text-lg whitespace-nowrap">
                <?php echo e(__('Tidak ada pengumuman saat ini.')); ?>

            </p>
        </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card bg-sky-50 dark:bg-sky-900/30">
            <div class="flex items-center">
                <div class="text-sky-600 dark:text-sky-400 text-4xl mr-4">👤</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('messages.customer_id')); ?></p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($user->customer_id ?? 'N/A'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="card bg-green-50 dark:bg-green-900/30">
            <div class="flex items-center">
                <div class="text-green-600 dark:text-green-400 text-4xl mr-4">📊</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('messages.total_bills')); ?></p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($totalBills); ?></p>
                </div>
            </div>
        </div>
        
        <div class="card bg-red-50 dark:bg-red-900/30">
            <div class="flex items-center">
                <div class="text-red-600 dark:text-red-400 text-4xl mr-4">⚠️</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('messages.unpaid_bills')); ?></p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($unpaidBills); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bills -->
    <div class="card">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white"><?php echo e(__('messages.recent_bills')); ?></h2>
            <?php if($totalBills > 0): ?>
                <div class="flex space-x-4">
                    <a href="<?php echo e(route('bills.create')); ?>" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300">
                        + <?php echo e(__('Submit Reading')); ?>

                    </a>
                    <a href="<?php echo e(route('billing-history')); ?>" class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300">
                        <?php echo e(__('messages.view')); ?> All →
                    </a>
                </div>
            <?php else: ?>
                <div class="flex space-x-4">
                    <a href="<?php echo e(route('bills.create')); ?>" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300">
                        + <?php echo e(__('Submit Reading')); ?>

                    </a>
                    <button type="button" 
                            onclick="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'No billing history yet', type: 'info' } }))"
                            class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 cursor-pointer">
                        <?php echo e(__('messages.view')); ?> All →
                    </button>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if($bills->count() > 0): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th><?php echo e(__('messages.usage')); ?></th>
                            <th><?php echo e(__('messages.total_cost')); ?></th>
                            <th><?php echo e(__('messages.status')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($bill->billing_month->format('M Y')); ?></td>
                                <td><?php echo e($bill->formatted_usage); ?></td>
                                <td><?php echo e($bill->formatted_total); ?></td>
                                <td>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        <?php echo e($bill->status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ''); ?>

                                        <?php echo e($bill->status == 'unpaid' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : ''); ?>

                                        <?php echo e($bill->status == 'overdue' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : ''); ?>">
                                        <?php echo e(__('messages.'.$bill->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center py-8 text-gray-600 dark:text-gray-400">No billing history yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/dashboard/index.blade.php ENDPATH**/ ?>
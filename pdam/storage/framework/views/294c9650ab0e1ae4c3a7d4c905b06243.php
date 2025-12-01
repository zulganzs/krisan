

<?php $__env->startSection('title', __('messages.contact')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4"><?php echo e(__('pages.contact_title')); ?></h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8"><?php echo e(__('pages.contact_subtitle')); ?></p>
    
    <div class="card">
        <form method="POST" action="#" class="space-y-4">
            <?php echo csrf_field(); ?>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <?php echo e(__('pages.subject')); ?>

                </label>
                <input type="text" name="subject" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <?php echo e(__('pages.category')); ?>

                </label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required>
                    <option value="leak_report"><?php echo e(__('pages.leak_report')); ?></option>
                    <option value="billing_inquiry"><?php echo e(__('pages.billing_inquiry')); ?></option>
                    <option value="connection_request"><?php echo e(__('pages.connection_request')); ?></option>
                    <option value="other"><?php echo e(__('pages.other')); ?></option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <?php echo e(__('pages.message')); ?>

                </label>
                <textarea name="message" rows="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required></textarea>
            </div>

            <button type="submit" class="btn-primary w-full">
                <?php echo e(__('messages.submit')); ?>

            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/contact.blade.php ENDPATH**/ ?>
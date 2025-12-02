

<?php $__env->startSection('title', __('messages.bill_simulator')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-8"><?php echo e(__('messages.bill_simulator')); ?></h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-slate-800 dark:text-white mb-6 flex items-center">
                    <span class="bg-cyan-100 text-cyan-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </span>
                    <?php echo e(__('messages.calculate')); ?>

                </h2>
                
                <form action="<?php echo e(route('bill-simulator.calculate')); ?>" method="POST" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            <?php echo e(__('messages.previous_reading')); ?> (m³)
                        </label>
                        <input type="number" 
                               name="previous_reading" 
                               step="0.01" 
                               value="<?php echo e(old('previous_reading', $previous_reading ?? '')); ?>" 
                               class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:bg-gray-700 dark:text-white transition-colors" 
                               placeholder="0"
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
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            <?php echo e(__('messages.current_reading')); ?> (m³)
                        </label>
                        <input type="number" 
                               name="current_reading" 
                               step="0.01" 
                               value="<?php echo e(old('current_reading', $current_reading ?? '')); ?>" 
                               class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:bg-gray-700 dark:text-white transition-colors" 
                               placeholder="0"
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
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            <?php echo e(__('messages.admin_fee')); ?> (Rp)
                        </label>
                        <input type="number" 
                               name="admin_fee" 
                               value="<?php echo e(old('admin_fee', $admin_fee ?? 2500)); ?>" 
                               class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:bg-gray-700 dark:text-white transition-colors">
                    </div>

                    <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-3 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                        <?php echo e(__('messages.calculate')); ?>

                    </button>
                </form>
            </div>
        </div>

        <!-- Calculation Result -->
        <div class="relative">
            <?php if(isset($result)): ?>
                <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
                    <div x-show="show" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform -translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="bg-sky-50 dark:bg-sky-900/20 border-l-4 border-cyan-500 rounded-r-xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-slate-800 dark:text-white mb-6 flex items-center">
                                <span class="bg-cyan-100 text-cyan-600 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </span>
                                <?php echo e(__('messages.calculation_result')); ?>

                            </h2>
                            
                            <!-- ARITHMETIC RESULT: Display calculation breakdown -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700/50">
                                    <span class="text-slate-600 dark:text-slate-400"><?php echo e(__('messages.usage')); ?>:</span>
                                    <span class="font-semibold text-slate-900 dark:text-white"><?php echo e(number_format($result['usage'], 2)); ?> m³</span>
                                </div>
                                
                                <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700/50">
                                    <span class="text-slate-600 dark:text-slate-400"><?php echo e(__('messages.base_cost')); ?>:</span>
                                    <span class="font-semibold text-slate-900 dark:text-white">Rp <?php echo e(number_format($result['water_cost'], 0, ',', '.')); ?></span>
                                </div>
                                
                                <div class="flex justify-between items-center pb-3 border-b border-sky-200 dark:border-sky-700/50">
                                    <span class="text-slate-600 dark:text-slate-400"><?php echo e(__('messages.admin_fee')); ?>:</span>
                                    <span class="font-semibold text-slate-900 dark:text-white">Rp <?php echo e(number_format($result['admin_fee'], 0, ',', '.')); ?></span>
                                </div>
                                
                                <div class="mt-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-sky-100 dark:border-sky-800">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-slate-900 dark:text-white"><?php echo e(__('messages.total_cost')); ?>:</span>
                                        <span class="text-3xl font-bold text-cyan-600 dark:text-cyan-400">Rp <?php echo e(number_format($result['total_cost'], 0, ',', '.')); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 text-xs text-slate-500 dark:text-slate-400 text-center">
                                <?php echo e(__('messages.formula')); ?>: (Air Rp <?php echo e(number_format($result['water_cost'], 0, ',', '.')); ?>) + (Admin Rp <?php echo e(number_format($result['admin_fee'], 0, ',', '.')); ?>)
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-slate-50 dark:bg-gray-800 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700 p-12 text-center h-full flex flex-col items-center justify-center">
                    <div class="text-6xl mb-4 opacity-50">🧮</div>
                    <p class="text-slate-500 dark:text-slate-400 font-medium"><?php echo e(__('messages.enter_readings')); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- How it works -->
    <div class="mt-12 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">
            <?php echo e(__('messages.how_it_works')); ?>

        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-sky-100 rounded-full p-2 text-sky-600 mr-4">
                    <span class="font-bold text-sm">1</span>
                </div>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed"><?php echo e(__('messages.tier_1_desc')); ?></p>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-sky-100 rounded-full p-2 text-sky-600 mr-4">
                    <span class="font-bold text-sm">2</span>
                </div>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed"><?php echo e(__('messages.tier_2_desc')); ?></p>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 bg-sky-100 rounded-full p-2 text-sky-600 mr-4">
                    <span class="font-bold text-sm">3</span>
                </div>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed"><?php echo e(__('messages.tier_3_desc')); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\omega\Desktop\krisan\pdam\resources\views/bill-simulator.blade.php ENDPATH**/ ?>
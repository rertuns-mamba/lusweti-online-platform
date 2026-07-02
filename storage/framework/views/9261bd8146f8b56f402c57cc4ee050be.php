<section class="w-full font-sans max-w-5xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
    <?php echo $__env->make('partials.settings-heading', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <h2 class="sr-only"><?php echo e(__('Appearance settings')); ?></h2>

    <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 border-t border-zinc-200 dark:border-zinc-800">
        
        <div class="space-y-1">
            <h3 class="text-lg font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
                <?php echo e(__('Appearance')); ?>

            </h3>
            <p class="text-sm text-zinc-600 dark:text-zinc-400 max-w-xs leading-relaxed">
                <?php echo e(__('Update the appearance settings for your account')); ?>

            </p>
        </div>

        <div class="md:col-span-2">
            <fieldset x-data="{ currentTheme: <?php if ((object) ('appearance') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('appearance'->value()); ?>')<?php echo e('appearance'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('appearance'); ?>')<?php endif; ?> }">
                <legend class="sr-only"><?php echo e(__('Choose a display theme')); ?></legend>
                
                <div class="inline-flex flex-col sm:flex-row p-1 bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 w-full sm:w-auto">
                    
                    <label class="relative flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold tracking-wide uppercase transition-all cursor-pointer select-none grow sm:grow-0"
                        :class="currentTheme === 'light' ? 'bg-zinc-950 text-white dark:bg-white dark:text-zinc-950 shadow-sm' : 'text-zinc-700 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                    >
                        <input type="radio" name="appearance" value="light" wire:model.live="appearance" class="sr-only">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span><?php echo e(__('Light')); ?></span>
                    </label>

                    <label class="relative flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold tracking-wide uppercase transition-all cursor-pointer select-none grow sm:grow-0 border-t sm:border-t-0 sm:border-x border-zinc-200 dark:border-zinc-700/50"
                        :class="currentTheme === 'dark' ? 'bg-zinc-950 text-white dark:bg-white dark:text-zinc-950 shadow-sm' : 'text-zinc-700 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                    >
                        <input type="radio" name="appearance" value="dark" wire:model.live="appearance" class="sr-only">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <span><?php echo e(__('Dark')); ?></span>
                    </label>

                    <label class="relative flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold tracking-wide uppercase transition-all cursor-pointer select-none grow sm:grow-0"
                        :class="currentTheme === 'system' ? 'bg-zinc-950 text-white dark:bg-white dark:text-zinc-950 shadow-sm' : 'text-zinc-700 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                    >
                        <input type="radio" name="appearance" value="system" wire:model.live="appearance" class="sr-only">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span><?php echo e(__('System')); ?></span>
                    </label>

                </div>
            </fieldset>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['appearance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400 tracking-wide uppercase">
                    <?php echo e($message); ?>

                </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\auth\settings\appearance.blade.php ENDPATH**/ ?>
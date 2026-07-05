<div
    x-data="{ 
        isOpen: <?php echo json_encode($errors->isNotEmpty(), 15, 512) ?>,
        showPassword: false 
    }"
    x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') isOpen = true"
    x-on:close-modal.window="isOpen = false; showPassword = false; $wire.set('password', '')"
    x-on:keydown.escape.window="isOpen = false"
    class="relative z-50 font-sans"
    style="display: none;"
    x-show="isOpen"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
>
    <div 
        x-show="isOpen"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-950/80 backdrop-blur-sm transition-opacity"
    ></div>

    <div class="fixed inset-0 z-50 w-screen overflow-y-auto p-4 sm:p-6 md:p-20 flex items-center justify-center">
        <div 
            x-show="isOpen"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="isOpen = false"
            class="w-full max-w-lg bg-white border border-zinc-300 rounded-none shadow-xl dark:bg-zinc-900 dark:border-zinc-700 overflow-hidden"
        >
            <form method="POST" wire:submit="deleteUser" class="p-6 sm:p-8 space-y-6">
                
                <div class="space-y-2 border-b border-zinc-200 pb-4 dark:border-zinc-800">
                    <h3 id="modal-title" class="text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
                        <?php echo e(__('Are you sure you want to delete your account?')); ?>

                    </h3>
                    <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                        <?php echo e(__('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')); ?>

                    </p>
                </div>

                <div class="space-y-1">
                    <label for="confirmation-password" class="block text-sm font-bold tracking-wide text-zinc-900 dark:text-zinc-200 uppercase">
                        <?php echo e(__('Password')); ?>

                    </label>
                    <div class="relative mt-1">
                        <input 
                            id="confirmation-password"
                            wire:model="password" 
                            :type="showPassword ? 'text' : 'password'" 
                            class="w-full px-4 py-3 font-mono text-sm border bg-zinc-50 border-zinc-300 rounded-none focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-black dark:border-zinc-700 dark:text-white dark:focus:ring-white"
                            required
                        />
                        <button 
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 focus:outline-none"
                            aria-label="Toggle password visibility"
                        >
                            <template x-if="!showPassword">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </template>
                            <template x-if="showPassword">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </template>
                        </button>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs font-semibold tracking-wide text-red-600 dark:text-red-400 uppercase">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <button 
                        type="button" 
                        @click="isOpen = false; showPassword = false; $wire.set('password', '')"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold tracking-wide uppercase bg-zinc-100 text-zinc-900 border border-zinc-200 transition-colors hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-700 dark:hover:bg-zinc-700 dark:focus:ring-white"
                    >
                        <?php echo e(__('Cancel')); ?>

                    </button>

                    <button 
                        type="submit" 
                        data-test="confirm-delete-user-button"
                        wire:loading.attr="disabled"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold tracking-wide uppercase bg-red-700 text-white border border-transparent transition-colors hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 disabled:opacity-50 dark:focus:ring-offset-zinc-900"
                    >
                        <span wire:loading.remove wire:target="deleteUser"><?php echo e(__('Delete account')); ?></span>
                        <span wire:loading wire:target="deleteUser" class="inline-flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <?php echo e(__('Processing...')); ?>

                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\auth\settings\delete-user-modal.blade.php ENDPATH**/ ?>
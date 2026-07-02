<div wire:poll.5s class="flex items-center">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin || $isStreamLive): ?>
        <a href="<?php echo e(route('stream')); ?>"
            class="group relative inline-flex items-center gap-2.5 px-1 py-4 text-sm font-bold tracking-widest uppercase transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 dark:focus:ring-white dark:focus:ring-offset-zinc-900 <?php echo e(request()->is('stream') ? 'text-red-600' : 'text-zinc-900 hover:text-red-600 dark:text-zinc-100 dark:hover:text-red-500'); ?>">

            <span class="relative flex items-center justify-center w-2.5 h-2.5" aria-hidden="true">
                <span
                    class="absolute inline-flex w-full h-full bg-red-600 rounded-full opacity-75 <?php echo e(request()->is('stream') ? 'animate-ping' : 'group-hover:animate-ping'); ?>"></span>
                <span class="relative inline-flex w-2 h-2 bg-red-600 rounded-full"></span>
            </span>

            <span>Watch Live</span>

            <span
                class="absolute bottom-0 left-0 w-full h-[4px] bg-red-600 origin-left transform transition-transform duration-150 ease-out <?php echo e(request()->is('stream') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100'); ?>"></span>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\navigation\watch-live-button.blade.php ENDPATH**/ ?>
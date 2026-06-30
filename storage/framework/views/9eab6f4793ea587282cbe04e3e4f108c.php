<div class="w-full bg-[#B80000] text-white border-b-4 border-black font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between py-2 sm:py-3">            
            
            <span class="text-[12px] font-bold uppercase tracking-wider text-white drop-shadow-sm">
                <?php echo e($tagline); ?>

            </span>            
            
            <time class="mt-1 sm:mt-0 text-[12px] font-semibold text-red-100 uppercase tracking-wide" 
                  datetime="<?php echo e($formattedDate['iso']); ?>">
                <?php echo e($formattedDate['human']); ?>

            </time>

        </div>
    </div>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/global/page-header.blade.php ENDPATH**/ ?>
<div class="w-full bg-[#B80000] border-b-4 border-black">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->hasBreaking()): ?>
    <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'breaking-ticker'; ?>wire:key="breaking-ticker"
        class="text-white text-sm font-bold flex items-stretch overflow-hidden h-10">

        
        <div class="px-4 bg-black text-white uppercase tracking-widest font-black shrink-0 z-20 flex items-center gap-3 border-r-2 border-[#B80000]">
            <span class="w-2.5 h-2.5 bg-red-600 animate-pulse" aria-hidden="true"></span>
            <span class="text-xs md:text-sm pt-0.5">Breaking</span>
        </div>

        
        <div class="flex-1 overflow-hidden whitespace-nowrap flex items-center relative z-10">
            <div class="ticker-track hover:pause flex items-center">

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 0; $i < 4; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex items-center shrink-0" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'ticker-group-'.e($i).''; ?>wire:key="ticker-group-<?php echo e($i); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->breakingItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                    $isInternal = str_starts_with($item->url, config('app.url')) || str_starts_with($item->url, '#');
                    ?>

                    <div class="flex items-center gap-3 px-6 border-l border-red-800/50 first:border-l-0 h-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'breaking-'.e($item->id).'-'.e($i).''; ?>wire:key="breaking-<?php echo e($item->id); ?>-<?php echo e($i); ?>">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->is_live): ?>
                        <span class="bg-white animate-pulse text-[#B80000] px-1.5 py-0.5 text-[10px] font-black tracking-widest uppercase block select-none leading-none">
                            Live
                        </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <a href="<?php echo e($item->url); ?>"
                            <?php if($isInternal): ?> wire:navigate.hover <?php else: ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>
                            class="text-white text-sm font-bold tracking-normal hover:underline underline-offset-4 decoration-2 transition-none pt-0.5">
                            <?php echo e($item->display_title ?? $item->title); ?>

                        </a>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>
    </div>

</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\breaking-news.blade.php ENDPATH**/ ?>
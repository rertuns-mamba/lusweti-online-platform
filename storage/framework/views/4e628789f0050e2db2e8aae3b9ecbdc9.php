<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category && $this->columnLayouts['featured']): ?>
    <section class="py-10 text-slate-900 antialiased bg-white">

        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a href="/cbs/<?php echo e($section->page->slug); ?>" 
                    class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-none"
                    style="background-color: <?php echo e($section->page->bg_color); ?>; color: <?php echo e($section->page->text_color); ?>;">
                    <?php echo e($this->category->name); ?>

                </a>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Latest Hadithi</span>
            </div>
            <a href="/cbs/<?php echo e($section->page->slug); ?>" class="text-xs font-bold uppercase text-slate-500 hover:text-slate-900">See All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-6">
            
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <?php $hero = $this->columnLayouts['featured']; ?>
                <a href="<?php echo e(route('article.show', [$section->page->slug, $hero->slug])); ?>" wire:navigate class="group block space-y-3.5">
                    <div class="relative overflow-hidden aspect-video bg-slate-100">
                        <img src="<?php echo e($hero->getFirstMediaUrl('featured_image', 'hero')); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-950 group-hover:underline"><?php echo e($hero->title); ?></h3>
                    <p class="text-sm text-slate-600 line-clamp-3"><?php echo e($hero->summary); ?></p>
                </a>
            </div>

            
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0 space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->columnLayouts['thumbnails']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('article.show', [$section->page->slug, $item->slug])); ?>" wire:navigate class="group flex gap-4 border-b border-slate-100 pb-4 last:border-0 items-start">
                    <div class="h-16 w-24 flex-shrink-0 overflow-hidden bg-slate-100">
                        <img src="<?php echo e($item->getFirstMediaUrl('featured_image', 'thumb')); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-sm font-bold text-slate-950 group-hover:underline line-clamp-2"><?php echo e($item->title); ?></h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-1"><?php echo e($item->published_at->diffForHumans()); ?></p>
                    </div>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="lg:col-span-4 space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->columnLayouts['textOnly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('article.show', [$section->page->slug, $item->slug])); ?>" wire:navigate class="group block border-l-2 border-slate-200 pl-4 hover:border-slate-900 transition-colors">
                    <h3 class="text-sm font-bold text-slate-800 group-hover:text-slate-950 group-hover:underline line-clamp-2"><?php echo e($item->title); ?></h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1"><?php echo e($item->published_at->diffForHumans()); ?></p>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/sections/hadithi-grid.blade.php ENDPATH**/ ?>
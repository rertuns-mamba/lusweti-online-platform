<section class="w-full py-10 bg-white text-neutral-900 antialiased font-sans">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category && $this->collectionItems->isNotEmpty()): ?>

    <div class="flex items-end justify-between border-b-2 border-neutral-900 pb-2 mb-6">
        <h2 class="text-xl font-black uppercase tracking-tight text-neutral-900 flex items-center gap-2.5">
            <span class="w-3 h-6 bg-red-600 rounded-none block" aria-hidden="true"></span>
            <?php echo e($this->category->name); ?>

        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->collectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <article <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'external-'.e($article->id).''; ?>wire:key="external-<?php echo e($article->id); ?>" 
                 class="group relative flex flex-col bg-white border border-neutral-200">
            
            <a href="<?php echo e($article->external_url); ?>" target="_blank" rel="noopener noreferrer" class="absolute inset-0 z-10"></a>

            <div class="relative aspect-[16/9] w-full overflow-hidden bg-neutral-100">
                <img src="<?php echo e($article->featured_image_thumb_url); ?>" 
                     alt="<?php echo e($article->title); ?>" 
                     loading="lazy"
                     class="w-full h-full object-cover">
                
                <div class="absolute top-0 right-0 inline-flex items-center gap-1 bg-neutral-950 text-white px-2 py-1 text-[9px] font-black uppercase">
                    <span>External</span>
                </div>
            </div>

            <div class="flex flex-col flex-1 p-4 relative z-20 space-y-4">
                <h3 class="text-sm font-extrabold text-neutral-900 leading-snug line-clamp-2 group-hover:underline">
                    <?php echo e($article->title); ?>

                </h3>
                <p class="text-xs text-neutral-600 line-clamp-2"><?php echo e($article->summary); ?></p>

                <div class="pt-3 border-t border-neutral-100">
                    <time class="text-[10px] font-bold text-red-700 uppercase"><?php echo e($article->published_at->diffForHumans()); ?></time>
                    <p class="text-[10px] font-medium text-neutral-400 uppercase tracking-tight">
                        Source: <?php echo e(parse_url($article->external_url, PHP_URL_HOST)); ?>

                    </p>
                </div>
            </div>
        </article>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</section><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\external-feed.blade.php ENDPATH**/ ?>
<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category && $this->columnLayouts['featured']): ?>
    <section class="w-full py-4 bg-white font-sans">
        
        <a name="<?php echo e($this->category->slug); ?>"></a>

        <div class="mx-auto mt-4">
            <div class="flex items-end justify-between border-b-2 border-gray-900 pb-2">
                <a href="/cbs/<?php echo e($this->category->slug); ?>"
                   wire:navigate
                   class="inline-block px-3 py-1 text-xs font-black uppercase tracking-widest rounded-none transition-opacity hover:opacity-90"
                   style="background: <?php echo e($this->category->bg_color ?? '#e50000'); ?>; color: <?php echo e($this->category->text_color ?? '#ffffff'); ?>;">
                    <?php echo e($this->category->name); ?>

                </a>

                <a href="/cbs/<?php echo e($this->category->slug); ?>"
                   wire:navigate
                   class="text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-red-600 flex items-center gap-1 transition-colors">
                    All <?php echo e($this->category->name); ?>

                    <svg class="w-3 h-3 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="mx-auto mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-5 border-b border-gray-200 pb-6 lg:border-b-0 lg:pb-0">
                <?php $featuredItem = $this->columnLayouts['featured']; ?>
                <a href="<?php echo e(route('article.show', [$this->category->slug, $featuredItem->slug])); ?>" wire:navigate class="block group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredItem->featured_image_url): ?>
                        <div class="aspect-[16/10] bg-gray-100 overflow-hidden relative">
                            <img src="<?php echo e($featuredItem->featured_image_url); ?>" alt="<?php echo e($featuredItem->title); ?>" class="w-full h-full object-cover rounded-none transition-transform duration-300 group-hover:scale-102">
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="mt-3 space-y-2">
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight leading-tight group-hover:text-red-600 transition-colors">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredItem->is_prime): ?>
                                <span class="inline-block text-[10px] font-black tracking-wider px-1.5 py-0.5 bg-red-600 text-white rounded-none align-middle mr-1.5">PRIME</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php echo e($featuredItem->title); ?>

                        </h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredItem->summary): ?>
                            <p class="text-xs font-normal text-gray-600 leading-relaxed line-clamp-3">
                                <?php echo e($featuredItem->summary); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="flex items-center gap-2 text-[11px] font-medium text-gray-400 pt-1">
                            <span class="font-bold tracking-wider uppercase text-gray-700"><?php echo e($this->category->name); ?></span>
                            <span>•</span>
                            <span><?php echo e($featuredItem->published_at->diffForHumans()); ?></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="lg:col-span-4 space-y-4 border-b border-gray-200 pb-6 lg:border-b-0 lg:pb-0 md:border-r md:border-gray-100 md:pr-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->columnLayouts['thumbnails']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thumbItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('article.show', [$this->category->slug, $thumbItem->slug])); ?>" wire:navigate class="flex gap-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0 group">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors leading-snug">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($thumbItem->is_prime): ?>
                                    <span class="inline-block text-[9px] font-black tracking-wider px-1 py-0.5 bg-red-600 text-white rounded-none align-middle mr-1">PRIME</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php echo e($thumbItem->title); ?>

                            </h3>
                            <div class="mt-1.5 text-[10px] text-gray-400 flex items-center gap-1.5">
                                <span class="font-bold tracking-wider uppercase text-gray-600"><?php echo e($this->category->name); ?></span>
                                <span>•</span>
                                <span><?php echo e($thumbItem->published_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($thumbItem->featured_image_thumb_url): ?>
                            <div class="w-20 h-20 bg-gray-100 shrink-0 relative">
                                <img src="<?php echo e($thumbItem->featured_image_thumb_url); ?>" alt="<?php echo e($thumbItem->title); ?>" class="w-full h-full object-cover rounded-none">
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="lg:col-span-3 space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->columnLayouts['textOnly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $textItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('article.show', [$this->category->slug, $textItem->slug])); ?>" wire:navigate class="block pb-4 border-b border-gray-100 last:border-0 last:pb-0 group">
                        <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors leading-snug">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($textItem->is_prime): ?>
                                <span class="inline-block text-[9px] font-black tracking-wider px-1 py-0.5 bg-red-600 text-white rounded-none align-middle mr-1">PRIME</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php echo e($textItem->title); ?>

                        </h3>
                        <div class="mt-1.5 text-[10px] text-gray-400 flex items-center gap-1.5">
                            <span class="font-bold tracking-wider uppercase text-gray-600"><?php echo e($this->category->name); ?></span>
                            <span>•</span>
                            <span><?php echo e($textItem->published_at->diffForHumans()); ?></span>
                        </div>
                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

        </div>

    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\spoti-majuu-block.blade.php ENDPATH**/ ?>
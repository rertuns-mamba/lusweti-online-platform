<div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category && $this->collectionItems->isNotEmpty()): ?>

    <section id="<?php echo e($this->page?->slug ?? 'galleries-section'); ?>" class="w-full py-10 mx-auto bg-white text-slate-900 antialiased">

        
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex items-start gap-3">
                
                <div class="w-3 h-8 shrink-0 rounded-none block"
                    style="background-color: <?php echo e($this->page?->bg_color ?? '#111827'); ?>">
                </div>

                <div class="space-y-1">
                    <h2 class="text-2xl  font-black tracking-tight text-neutral-900 uppercase">
                        <?php echo e($this->category->title); ?>

                    </h2>
                    <p class="text-xs font-normal text-neutral-500">
                        <?php echo e($this->settings['subtitle'] ?? 'Browse the latest featured photo galleries'); ?>

                    </p>
                </div>
            </div>

            
            <a href="/<?php echo e($this->page?->slug ?? 'galleries'); ?>"
                wire:navigate
                class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 transition-colors">
                View All <?php echo e($this->category->title); ?>

                <span class="text-sm font-normal">&rarr;</span>
            </a>
        </div>

        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->collectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <article <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'gallery-teaser-'.e($gallery->id).''; ?>wire:key="gallery-teaser-<?php echo e($gallery->id); ?>" class="group bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 flex flex-col">
                
                
                <a href="<?php echo e(route('article.show', [$this->page?->slug ?? 'galleries', $gallery->slug])); ?>"
                    wire:navigate
                    class="block h-full bg-transparent outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 cursor-pointer">

                    
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-900 rounded-none mb-3">
                        
                        
                        <img src="<?php echo e($gallery->featured_image_thumb_url
                                ?: $gallery->getFirstMediaUrl('featured_image', 'thumb')
                                ?: $gallery->getFirstMediaUrl('featured_image')
                                ?: $gallery->getFirstMediaUrl('images')
                                ?: $gallery->image_path
                                ?: asset('images/placeholders/article-default.jpg')); ?>"
                            alt="<?php echo e($gallery->title); ?>"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 group-focus:scale-105">

                        
                        <div class="absolute bottom-0 left-0 bg-slate-900/90 text-white text-[10px] font-black uppercase tracking-widest px-2.5 py-1.5 flex items-center gap-1.5">
                            <svg class="w-3 h-3 fill-current text-blue-500" viewBox="0 0 24 24">
                                <path d="M4 4h3l2-2h6l2 2h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2m8 3a5 5 0 0 0-5 5 5 5 0 0 0 5 5 5 5 0 0 0 5-5 5 5 0 0 0-5-5m0 2a3 3 0 0 1 3 3 3 3 0 0 1-3 3 3 3 0 0 1-3-3 3 3 0 0 1 3-3Z"/>
                            </svg>
                            <span>Photos</span>
                        </div>

                        
                        <div class="absolute bottom-0 right-0 bg-slate-950/70 text-white text-[10px] font-bold px-2 py-1.5">
                            <?php echo e(\Carbon\Carbon::parse($gallery->published_at)->isoFormat('MMM D')); ?>

                        </div>
                    </div>

                    
                    <div class="space-y-1">
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="text-blue-600 font-extrabold"><?php echo e($this->category->title); ?></span>
                        </div>

                        <h3 class="text-base font-bold leading-snug text-slate-900 group-hover:underline group-focus:underline tracking-tight line-clamp-3">
                            <?php echo e($gallery->title); ?>

                        </h3>
                    </div>
                </a>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

        
        <div class="mt-8 px-4 text-center md:hidden">
            <a href="/<?php echo e($this->page?->slug ?? 'galleries'); ?>"
                wire:navigate
                class="block w-full py-3 bg-slate-900 text-white text-xs font-bold uppercase tracking-wider rounded-none transition-colors hover:bg-slate-800">
                View All Galleries &rarr;
            </a>
        </div>

    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\galleries.blade.php ENDPATH**/ ?>
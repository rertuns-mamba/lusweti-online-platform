<div class="w-full py-10 mx-auto bg-white text-slate-900 antialiased font-sans">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->featuredItem): ?>
    
        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex items-center gap-4">
                <a href="/cbs/<?php echo e($this->category->slug); ?>"
                    wire:navigate
                    class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-none"
                    style="background-color: <?php echo e($page?->bg_color ?? '#111827'); ?>; color: <?php echo e($page?->text_color ?? '#ffffff'); ?>;">
                    <?php echo e($this->category->title); ?>

                </a>
                <span class="h-4 w-[1px] bg-slate-300 hidden sm:inline"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Latest Updates</span>
            </div>
        </div>

        
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:gap-8 lg:items-start">

            
            <section class="border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <a href="<?php echo e(route('article.show', [$this->category->slug, $this->featuredItem->slug])); ?>"
                    wire:navigate
                    class="group block h-full">
                    
                    <div class="space-y-3">
                        <h3 class="text-xl sm:text-2xl font-extrabold leading-tight tracking-tight text-slate-950 group-hover:underline decoration-1">
                            <?php echo e($this->featuredItem->title); ?>

                        </h3>

                        <p class="text-sm leading-relaxed text-slate-600 font-normal">
                            <?php echo e($this->featuredItem->summary); ?>

                        </p>

                        <div class="pt-1 flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            <span class="font-extrabold tracking-normal" style="color: <?php echo e($page?->bg_color ?? '#b91c1c'); ?>"><?php echo e($this->category->title); ?></span>
                            <span class="text-slate-300 font-normal">|</span>
                            <span><?php echo e($this->featuredItem->published_at?->diffForHumans(null, true, true)); ?> ago</span>
                        </div>
                    </div>
                </a>
            </section>

            
            <section class="border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <a href="<?php echo e(route('article.show', [$this->category->slug, $this->featuredItem->slug])); ?>"
                    wire:navigate
                    class="group block">
                    
                    <div class="relative overflow-hidden rounded-none bg-slate-100 aspect-video w-full">
                        <img src="<?php echo e($this->featuredItem->getFirstMediaUrl('featured_image', 'hero')); ?>"
                            alt="<?php echo e($this->featuredItem->title); ?>"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                    </div>
                </a>
            </section>

            
            <section class="flex flex-col h-full">
                <div class="mb-3 text-xs font-black uppercase tracking-wider border-b border-slate-100 pb-2 flex-shrink-0" style="color: <?php echo e($page?->bg_color ?? '#b91c1c'); ?>">
                    More From <?php echo e($this->category->title); ?>

                </div>

                
                <div class="editorial-feed-scroll overflow-y-auto pr-2 lg:max-h-[340px]">
                    <ol class="divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->standardItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li class="py-3.5 first:pt-0 last:pb-0">
                            <a href="<?php echo e(route('article.show', [$this->category->slug, $item->slug])); ?>"
                                wire:navigate
                                class="group block space-y-1.5">

                                <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline tracking-tight">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->is_prime): ?>
                                    <span class="inline-block text-[9px] font-black tracking-widest px-1.5 py-0.5 bg-slate-950 text-white rounded-none mr-1.5 align-middle">
                                        PRIME
                                    </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="align-middle"><?php echo e($item->title); ?></span>
                                </h3>

                                <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    <span class="font-extrabold tracking-normal" style="color: <?php echo e($page?->bg_color ?? '#b91c1c'); ?>"><?php echo e($this->category->title); ?></span>
                                    <span class="text-slate-300 font-normal">|</span>
                                    <span><?php echo e($item->published_at?->diffForHumans(null, true, true)); ?> ago</span>
                                </div>
                            </a>
                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ol>
                </div>
            </section>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/sections/editorial-grid-block.blade.php ENDPATH**/ ?>
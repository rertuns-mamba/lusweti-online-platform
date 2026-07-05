
<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($this->page) && $this->page && !empty($this->dynamicLayoutColumns['hero'])): ?>
    <section id="spotikenya" class="w-full py-10 mx-auto bg-white text-slate-900 antialiased">

        
        <header class="mb-8">
            <div class="flex items-center justify-between border-b-2 border-slate-900 pb-3">
                <h2 class="inline-block text-xs font-black uppercase tracking-widest text-white px-3 py-1.5 rounded-none"
                    style="background: <?php echo e($this->page->bg_color ?? '#111827'); ?>; color: <?php echo e($this->page->text_color ?? '#ffffff'); ?>;">
                    <a href="/<?php echo e($this->page->slug); ?>" wire:navigate>
                        <?php echo e($this->page->title); ?>

                    </a>
                </h2>

                <a href="/<?php echo e($this->page->slug); ?>"
                    wire:navigate
                    class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 flex items-center gap-1 transition-colors">
                    All <?php echo e($this->page->title); ?>

                    <span class="text-sm font-normal">&rarr;</span>
                </a>
            </div>
        </header>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mx-auto">

            
            <div class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <?php $heroItem = $this->dynamicLayoutColumns['hero']; ?>

                <a href="<?php echo e(route('article.show', [$this->page->slug, $heroItem->slug])); ?>"
                    wire:navigate
                    class="group block h-full bg-transparent">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroItem->featured_image_thumb_url): ?>
                    <div class="overflow-hidden bg-slate-100 mb-4 rounded-none">
                        <img src="<?php echo e($heroItem->featured_image_thumb_url); ?>" alt="<?php echo e($heroItem->title); ?>" loading="lazy"
                            class="w-full aspect-[16/10] object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="space-y-2.5">
                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-red-600 font-extrabold"><?php echo e($this->page->title); ?></span>
                            <span>•</span>
                            <span><?php echo e($heroItem->published_at?->diffForHumans()); ?></span>
                        </div>

                        <h3 class="text-xl font-black tracking-tight leading-snug text-slate-900 group-hover:underline md:text-2xl">
                            <?php echo e($heroItem->title); ?>

                        </h3>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroItem->summary): ?>
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 font-normal">
                            <?php echo e($heroItem->summary); ?>

                        </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </a>
            </div>

            
            <div class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <ul class="divide-y divide-slate-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->dynamicLayoutColumns['thumbnails']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thumbItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="py-4 first:pt-0 last:pb-0">
                        <a href="<?php echo e(route('article.show', [$this->page->slug, $thumbItem->slug])); ?>"
                            wire:navigate
                            class="group flex gap-4 items-start bg-transparent">

                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline tracking-tight line-clamp-3">
                                    <?php echo e($thumbItem->title); ?>

                                </h3>

                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1.5 flex gap-2">
                                    <span><?php echo e($this->page->title); ?></span>
                                    <span>•</span>
                                    <span><?php echo e($thumbItem->published_at?->diffForHumans()); ?></span>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($thumbItem->featured_image_thumb_url): ?>
                            <div class="w-1/3 flex-shrink-0 bg-slate-100 rounded-none overflow-hidden">
                                <img src="<?php echo e($thumbItem->featured_image_thumb_url); ?>" alt="<?php echo e($thumbItem->title); ?>" loading="lazy"
                                    class="w-full aspect-[16/10] object-cover">
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>

            
            <div class="lg:col-span-1">
                <ul class="divide-y divide-slate-200 border-t-2 border-slate-900 lg:border-t-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->dynamicLayoutColumns['textOnly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $textItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="py-3.5 first:pt-0 last:pb-0">
                        <a href="<?php echo e(route('article.show', [$this->page->slug, $textItem->slug])); ?>"
                            wire:navigate
                            class="group block bg-transparent">

                            <div class="flex items-start gap-3">
                                
                                <span class="text-lg font-light tracking-tight text-slate-300 group-hover:text-red-600 transition-colors">
                                    0<?php echo e($index + 1); ?>

                                </span>

                                <div class="flex-1">
                                    <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline">
                                        <?php echo e($textItem->title); ?>

                                    </h3>

                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1 flex gap-2">
                                        <span><?php echo e($this->page->title); ?></span>
                                        <span>•</span>
                                        <span><?php echo e($textItem->published_at?->diffForHumans()); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>

        </div>

        
        <div class="mt-12 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block">ADVERTISEMENT</span>
        </div>

    </section>
    <?php else: ?>
    <div class="p-10 text-center text-slate-400">
        
        <p>Content unavailable or no featured article selected.</p>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\spoti-kenya.blade.php ENDPATH**/ ?>
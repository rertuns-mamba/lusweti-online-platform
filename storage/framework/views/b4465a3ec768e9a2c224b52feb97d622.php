<div>
    <?php
        $count = max($articles->count(), 1);

        /*
        |--------------------------------------------------------------------------
        | Dynamic Radius Allocation
        |--------------------------------------------------------------------------
        | Maintains proper 3D transform depth balancing based on item totals.
        |
        */
        if ($count <= 4) {
            $mobileRadius = 140;
            $tabletRadius = 190;
            $desktopRadius = 210;
        } elseif ($count <= 6) {
            $mobileRadius = 170;
            $tabletRadius = 230;
            $desktopRadius = 250;
        } else {
            $mobileRadius = 190;
            $tabletRadius = 260;
            $desktopRadius = 290;
        }
    ?>

    <section class="relative w-full py-8 md:py- overflow-hidden bg-white font-sans">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category): ?>
            <div class="mx-auto max-w-7xl mb-4 px-4 md:px-0">
                <div class="border-t-2 border-[#B80000] pt-3">
                    <div class="flex items-end justify-between border-b-2 border-gray-900 pb-2">
                        <a href="/cbs/<?php echo e($this->category->slug); ?>"
                           wire:navigate
                           class="inline-block px-3 py-1 text-xs font-black uppercase tracking-widest rounded-none transition-opacity hover:opacity-90"
                           style="background: <?php echo e($this->category->bg_color ?? '#e50000'); ?>; color: <?php echo e($this->category->text_color ?? '#ffffff'); ?>;">
                            <?php echo e($this->category->name); ?>

                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($articles->isNotEmpty()): ?>
            <div class="news-stage">
                <div class="news-spinner"
                     style="
                        --total: <?php echo e($count); ?>;
                        --mobile-radius: <?php echo e($mobileRadius); ?>px;
                        --tablet-radius: <?php echo e($tabletRadius); ?>px;
                        --desktop-radius: <?php echo e($desktopRadius); ?>px;
                     ">
                     
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('article.show', [$this->category->slug ?? 'news', $article->slug])); ?>"
                           wire:navigate
                           class="news-card group cursor-pointer"
                           style="--i: <?php echo e($loop->iteration); ?>">
                           
                            <img src="<?php echo e($article->featured_image_thumb_url
                                    ?: $article->getFirstMediaUrl('featured_image', 'thumb')
                                    ?: $article->getFirstMediaUrl('featured_image')
                                    ?: $article->getFirstMediaUrl('images')
                                    ?: $article->image_path
                                    ?: asset('images/placeholders/article-default.jpg')); ?>"
                                 alt="<?php echo e($article->title); ?>"
                                 loading="lazy">

                            <div class="news-overlay"></div>

                            <div class="news-content">
                                <span class="news-category">
                                    <?php echo e($article->category->name ?? $this->category?->name ?? 'Latest'); ?>

                                </span>
                                <h3>
                                    <span class="hover-underline">
                                        <?php echo e($article->title); ?>

                                    </span>
                                </h3>
                            </div>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center text-gray-600 font-medium py-12 border-t border-gray-200 mx-4 max-w-6xl md:mx-auto">
                No news articles available at this time.
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </section>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/sections/latest-in-gallery.blade.php ENDPATH**/ ?>
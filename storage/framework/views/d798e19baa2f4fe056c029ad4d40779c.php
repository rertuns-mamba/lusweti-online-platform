
<!-- <div wire:poll.15s > -->
<div class="">
    <section class="bg-white text-slate-900 antialiased font-sans">
        <div class="grid grid-cols-1 gap-8 items-start xl:grid-cols-12">

            
            <div class="xl:col-span-8 space-y-8">

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredLargeLeft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('article.show', [$article->category->slug ?? 'news', $article->slug])); ?>"
                    wire:navigate
                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'hero-'.e($article->id).''; ?>wire:key="hero-<?php echo e($article->id); ?>"
                    class="group block border-b border-slate-200 pb-6 transition-all duration-300">

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">

                        
                        <div class="order-2 lg:order-1 lg:col-span-5 flex flex-col justify-between h-full py-1">
                            <div>
                                <div class="mb-3 flex items-center gap-3">
                                    <span class="inline-block px-2 py-0.5 text-[11px] font-extrabold uppercase tracking-wider text-white"
                                        style="background: <?php echo e($article->category->bg_color ?? '#D9381E'); ?>">
                                        <?php echo e($article->category->name ?? 'Update'); ?>

                                    </span>

                                    <span class="text-xs font-medium text-slate-500">
                                        <?php echo e($article->published_at->diffForHumans()); ?>

                                    </span>
                                </div>

                                <h2 class="text-2xl font-black tracking-tight leading-tight text-slate-900 group-hover:underline group-hover:text-slate-800 md:text-3xl">
                                    <?php echo e($article->title); ?>

                                </h2>

                                <p class="mt-3 line-clamp-4 text-sm leading-relaxed text-slate-600">
                                    <?php echo e($article->summary ?? 'Soma zaidi hapa...'); ?>

                                </p>
                            </div>

                            <div class="mt-4 flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-red-600">
                                <span>Soma zaidi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        
                        <div class="order-1 lg:order-2 lg:col-span-7 overflow-hidden bg-slate-100">
                            <div class="relative aspect-[16/10] w-full">
                                <img src="<?php echo e($article->featured_image_url ?? asset('images/placeholders/article-default.jpg')); ?>"
                                    alt="<?php echo e($article->title); ?>"
                                    loading="lazy"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-102">
                            </div>
                        </div>
                    </div>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    
                    <div class="divide-y divide-slate-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $textTeasers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('article.show', [$article->category->slug ?? 'news', $article->slug])); ?>"
                            wire:navigate
                            <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'text-'.e($article->id).''; ?>wire:key="text-<?php echo e($article->id); ?>"
                            class="group block py-4 first:pt-0 last:pb-0">

                            <div class="mb-2 flex items-center gap-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-red-600">
                                    <?php echo e($article->category->name ?? 'Update'); ?>

                                </span>
                                <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                <span class="text-[11px] text-slate-500">
                                    <?php echo e($article->published_at->diffForHumans()); ?>

                                </span>
                            </div>

                            <h3 class="line-clamp-3 text-base font-bold leading-snug text-slate-900 group-hover:underline">
                                <?php echo e($article->title); ?>

                            </h3>
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    
                    <div class="divide-y divide-slate-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $rightThumbnails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('article.show', [$article->category->slug ?? 'news', $article->slug])); ?>"
                            wire:navigate
                            <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'thumb-'.e($article->id).''; ?>wire:key="thumb-<?php echo e($article->id); ?>"
                            class="group flex gap-4 py-4 first:pt-0 last:pb-0">

                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden bg-slate-100 sm:h-24 sm:w-24">
                                <img src="<?php echo e($article->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg')); ?>"
                                    alt="<?php echo e($article->title); ?>"
                                    loading="lazy"
                                    class="h-full w-full object-cover">
                            </div>

                            <div class="flex flex-1 flex-col justify-between">
                                <div>
                                    <div class="mb-1 flex items-center gap-2">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                            <?php echo e($article->category->name ?? 'Update'); ?>

                                        </span>
                                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                        <span class="text-[10px] text-slate-400">
                                            <?php echo e($article->published_at->diffForHumans()); ?>

                                        </span>
                                    </div>

                                    <h3 class="line-clamp-2 text-sm font-bold leading-snug text-slate-900 group-hover:underline">
                                        <?php echo e($article->title); ?>

                                    </h3>
                                </div>
                            </div>
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                </div>

            </div>

            
            <aside class="xl:col-span-4 border-t border-slate-200 pt-6 xl:border-t-0 xl:pt-0">
                <div class="sticky top-6 space-y-8 max-h-[calc(100vh-3rem)] overflow-y-auto pr-1">

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeVideo): ?>
                    <?php
                        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/', $activeVideo->video_url ?? '', $youtubeMatches);
                        $youtubeId = $youtubeMatches[1] ?? null;
                    ?>
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">Latest Video</h2>
                        </div>
                        <div class="aspect-video overflow-hidden bg-black">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeVideo->is_youtube && $youtubeId): ?>
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo e($youtubeId); ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                            <?php else: ?>
                            <video src="<?php echo e($activeVideo->video_url ?: $activeVideo->getFirstMediaUrl('videos')); ?>"
                                poster="<?php echo e($activeVideo->image_path ?: $activeVideo->getFirstMediaUrl('featured_image') ?: asset('images/placeholders/article-default.jpg')); ?>"
                                preload="metadata"
                                controls
                                muted
                                playsinline
                                class="h-full w-full object-cover bg-black">
                                Your browser does not support embedded videos.
                            </video>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mt-2 py-1">
                            <h3 class="text-[10px] font-bold uppercase tracking-wider text-red-600"><?php echo e($activeVideo->category?->name ?? 'Video'); ?></h3>
                            <p class="mt-1 text-sm font-bold text-slate-900 leading-snug"><?php echo e($activeVideo->title); ?></p>
                        </div>
                    </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($imageItems) && $imageItems->isNotEmpty()): ?>
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">Latest Images</h2>
                        </div>
                        <div class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $imageItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <a href="<?php echo e(route('article.show', [$item->category->slug ?? 'news', $item->slug])); ?>" wire:navigate <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'image-item-'.e($item->id).''; ?>wire:key="image-item-<?php echo e($item->id); ?>" class="group flex gap-3 items-start border-b border-slate-100 pb-3 last:border-0 last:pb-0">
                                <div class="h-14 w-20 flex-shrink-0 overflow-hidden bg-slate-100">
                                    <img src="<?php echo e($item->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg')); ?>" alt="<?php echo e($item->title); ?>" loading="lazy" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug"><?php echo e($item->title); ?></p>
                                    <p class="mt-1 text-[10px] text-slate-400"><?php echo e($item->published_at?->diffForHumans() ?? now()->diffForHumans()); ?></p>
                                </div>
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($externalItems) && $externalItems->isNotEmpty()): ?>
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">External Links</h2>
                        </div>
                        <div class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $externalItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <a href="<?php echo e($item->external_url); ?>" target="_blank" rel="noopener noreferrer" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'external-'.e($item->id).''; ?>wire:key="external-<?php echo e($item->id); ?>" class="group block border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                                <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug"><?php echo e($item->title); ?></p>
                                <span class="mt-1 flex items-center gap-1.5 text-[10px] font-medium tracking-wide text-slate-400">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Open external source
                                </span>
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($relatedArticles) && $relatedArticles->isNotEmpty()): ?>
                    <section class="border-t-2 border-red-600 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-red-600">Related Stories</h2>
                        </div>
                        <div class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <a href="<?php echo e(route('article.show', [$relatedArticle->category->slug ?? 'news', $relatedArticle->slug])); ?>" wire:navigate <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'related-'.e($relatedArticle->id).''; ?>wire:key="related-<?php echo e($relatedArticle->id); ?>" class="group block border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                                <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug"><?php echo e($relatedArticle->title); ?></p>
                                <p class="mt-1 text-[10px] text-slate-400"><?php echo e($relatedArticle->published_at?->diffForHumans() ?? now()->diffForHumans()); ?></p>
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>
            </aside>

        </div>
    </section>

</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/sections/hero.blade.php ENDPATH**/ ?>
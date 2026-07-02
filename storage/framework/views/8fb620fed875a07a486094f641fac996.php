<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
   
    <div class="bg-white min-h-screen antialiased"
        x-data="{ 
            percent: 0, 
            copied: false, 
            copyToClipboard() {
                navigator.clipboard.writeText(window.location.href);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            }
        }"
        x-on:scroll.window="percent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100">

        
        <div class="fixed top-0 left-0 w-full h-[3px] z-[60] pointer-events-none">
            <div class="h-full bg-red-600 transition-all duration-150 ease-out will-change-[width]" 
                 :style="'width: ' + percent + '%'"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">

            
            <div class="mb-6 flex items-center">
                <a href="<?php echo e(route('home')); ?>" wire:navigate
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 hover:bg-slate-200 text-xs font-bold uppercase tracking-widest text-slate-800 shadow-sm transition-all duration-200">

                    <svg class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>

                    Back to <?php echo e($article->page->title ?? 'Home'); ?>

                </a>
            </div>

            
            <article class="max-w-4xl mx-auto">

                
                <header class="mb-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->category): ?>
                        <span class="inline-block text-xs font-black uppercase tracking-widest text-white px-3 py-1.5 rounded-none"
                            style="background: <?php echo e($article->page->bg_color ?? '#dc2626'); ?>;">
                            <?php echo e($article->category->name); ?>

                        </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <?php echo e($article->published_at?->format('j M Y, H:i') ?? $article->created_at->format('j M Y, H:i')); ?>

                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">
                        <?php echo e($article->title); ?>

                    </h1>
                </header>

                
                <div class="mb-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->video_url || $article->is_youtube): ?>
                        
                        <?php
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/', $article->video_url ?? '', $youtubeMatches);
                            $youtubeId = $youtubeMatches[1] ?? ($article->youtube_id ?? null);
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($youtubeId): ?>
                        <div class="relative aspect-video w-full bg-black overflow-hidden shadow-lg">
                            <iframe src="https://www.youtube.com/embed/<?php echo e($youtubeId); ?>?rel=0&modestbranding=1&playsinline=1" 
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen 
                                loading="lazy"
                                title="<?php echo e($article->title); ?>">
                            </iframe>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->external_url): ?>
                            <a href="<?php echo e($article->external_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="absolute top-4 right-4 z-50 px-4 py-2 text-xs font-bold text-white bg-red-600 rounded-lg backdrop-blur-sm transition-all duration-300 hover:bg-red-700 shadow-lg pointer-events-auto"
                                style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;">
                                Watch on YouTube
                                <svg class="w-4 h-4 ml-2 inline" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.654c-1.318-.72-3.43-.743-8.614-.743-5.185 0-7.298.023-8.616.743C2.047 4.374.96 5.42.96 8.05v7.9c0 2.678 1.113 3.754 2.425 4.396 1.32.72 3.43.743 8.614.743 5.186 0 7.298-.023 8.616-.743 1.312-.642 2.42-1.718 2.42-4.396V8.05c0-2.678-1.113-3.754-2.425-4.396zM8.5 15.5V8.5l7 3.5-7 3.5z" />
                                </svg>
                            </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php elseif($article->featured_image_url): ?>
                        
                        <div class="relative aspect-video w-full bg-slate-100 overflow-hidden shadow-lg">
                            <img src="<?php echo e($article->featured_image_url); ?>" 
                                alt="<?php echo e($article->title); ?>" 
                                loading="lazy"
                                class="w-full h-full object-cover">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->external_url): ?>
                            <a href="<?php echo e($article->external_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                onclick="window.open(this.href, '_blank'); return false;"
                                class="absolute top-4 right-4 z-50 px-4 py-2 text-xs font-bold text-white bg-red-600 rounded-lg backdrop-blur-sm transition-all duration-300 hover:bg-red-700 shadow-lg pointer-events-auto"
                                style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;">
                                Visit Source
                                <svg class="w-4 h-4 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="space-y-6">
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->summary): ?>
                    <p class="text-lg sm:text-xl text-slate-700 font-serif leading-relaxed italic border-l-4 border-red-600 pl-4">
                        <?php echo e($article->summary); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="prose prose-lg prose-slate max-w-none font-serif text-slate-800 leading-relaxed">
                        <?php echo $article->content; ?>

                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->external_url): ?>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <h3 class="text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">External Source</h3>
                        <a href="<?php echo e($article->external_url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            onclick="window.open(this.href, '_blank'); return false;"
                            class="text-red-600 hover:text-red-700 break-all text-sm font-semibold">
                            <?php echo e($article->external_url); ?>

                        </a>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="pt-8 border-t-2 border-slate-900 mt-8">
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4">

                        <span class="text-sm font-bold text-slate-800 uppercase tracking-wider">Share</span>

                        
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($article->title)); ?>"
                            target="_blank"
                            class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-black transition-all duration-200 border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                            </svg>
                        </a>

                        
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(url()->current())); ?>"
                            target="_blank"
                            class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-blue-700 transition-all duration-200 border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/>
                            </svg>
                        </a>

                        
                        <div class="relative">
                            <button @click="copyToClipboard"
                                class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-red-600 transition-all duration-200 border border-transparent">
                                
                                <svg x-show="!copied" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2"/>
                                </svg>

                                <svg x-show="copied" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>

                            <span x-show="copied"
                                x-transition
                                class="absolute -bottom-9 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded shadow">
                                Copied!
                            </span>
                        </div>

                    </div>
                </div>

            </article>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedArticles->count() > 0): ?>
        <section class="bg-slate-50 border-t-2 border-slate-900 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900">More from <?php echo e($article->category->name ?? 'Articles'); ?></h3>
                        <div class="h-1 w-16 bg-red-600 mt-2"></div>
                    </div>

                    <a href="<?php echo e(route('home')); ?>"
                        class="text-sm font-bold text-red-600 hover:text-red-700 flex items-center gap-2 uppercase tracking-wider">
                        View All
                        <span class="text-lg">&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('article.show', [$article->page->slug ?? 'home', $relatedArticle->slug])); ?>"
                        wire:navigate
                        class="group block bg-white rounded-none shadow-sm hover:shadow-md transition-shadow duration-200">
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedArticle->featured_image_thumb_url): ?>
                        <div class="aspect-video w-full bg-slate-100 overflow-hidden">
                            <img src="<?php echo e($relatedArticle->featured_image_thumb_url); ?>" 
                                alt="<?php echo e($relatedArticle->title); ?>" 
                                loading="lazy"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="p-4">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-red-600 transition-colors line-clamp-2 leading-snug">
                                <?php echo e($relatedArticle->title); ?>

                            </h4>

                            <div class="flex items-center gap-2 mt-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                <span><?php echo e($relatedArticle->category->name ?? 'News'); ?></span>
                                <span>•</span>
                                <span><?php echo e($relatedArticle->published_at?->diffForHumans() ?? $relatedArticle->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

            </div>
        </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\articles\show.blade.php ENDPATH**/ ?>
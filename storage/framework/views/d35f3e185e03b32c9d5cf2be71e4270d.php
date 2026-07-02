<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => $video->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($video->title)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    // Listen for article mutations on the magazine-stream channel
                    window.Echo.channel('magazine-stream')
                        .listen('.article.mutated', (event) => {
                            // Reload the page to get updated related articles
                            window.location.reload();
                        });

                    // Also listen on the specific article channels if we have related articles
                    <?php if($relatedArticles->count() > 0): ?>
                        <?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            window.Echo.channel('articles.<?php echo e($article->id); ?>')
                                .listen('.article.mutated', (event) => {
                                    window.location.reload();
                                });
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                }
            });

            // Native UI: Share Button Copy Logic
            function copyVideoUrl() {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const btn = document.getElementById('share-btn');
                    const originalText = btn.innerHTML;
                    btn.innerHTML = `<svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Link Copied!`;
                    setTimeout(() => { btn.innerHTML = originalText; }, 2000);
                });
            }
        </script>
    <?php $__env->stopPush(); ?>

    <article class="min-h-screen bg-white text-gray-900 font-sans antialiased">
        
        <header class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6 border-b border-gray-200">
            <nav class="mb-6">
                <a href="<?php echo e(route('videos.index')); ?>" class="group flex items-center text-sm font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition-colors">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    All Videos
                </a>
            </nav>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tight">
                <?php echo e($video->title); ?>

            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->category): ?>
                    <span class="inline-block px-3 py-1 font-bold text-white bg-red-600 uppercase tracking-wider text-xs">
                        <?php echo e($video->category->name); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <time datetime="<?php echo e($video->published_at->toIso8601String()); ?>" class="text-gray-500 font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Published: <?php echo e($video->published_at->format('j F Y, H:i')); ?>

                </time>
            </div>
        </header>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                
                <div class="lg:col-span-2">
                    <figure class="bg-black w-full border border-gray-200 shadow-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->is_youtube && $video->youtube_id): ?>
                            <div class="aspect-video w-full">
                                <iframe 
                                    src="https://www.youtube.com/embed/<?php echo e($video->youtube_id); ?>" 
                                    class="w-full h-full"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        <?php elseif($video->getFirstMediaUrl('local_video')): ?>
                            <div class="aspect-video w-full">
                                <video 
                                    controls 
                                    class="w-full h-full object-contain"
                                    poster="<?php echo e($video->getFirstMediaUrl('custom_thumbnail') ?? $video->getFirstMediaUrl('local_video', 'thumb')); ?>">
                                    <source src="<?php echo e($video->getFirstMediaUrl('local_video')); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php else: ?>
                            <div class="aspect-video w-full flex items-center justify-center bg-gray-100 text-gray-500 border-2 border-dashed border-gray-300">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">Video currently unavailable</span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </figure>
                </div>

                <aside class="space-y-8">
                    <div class="border-t-4 border-gray-900 pt-6">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-4 flex items-center">
                            <span class="w-2 h-2 bg-red-600 mr-2 block"></span>
                            Share this Video
                        </h3>
                        <button 
                            id="share-btn"
                            onclick="copyVideoUrl()"
                            class="w-full flex items-center justify-center px-4 py-3 border-2 border-gray-200 text-gray-900 font-bold uppercase tracking-wider text-sm hover:border-gray-900 hover:bg-gray-50 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </aside>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedArticles->count() > 0): ?>
                <section class="mt-16 pt-8 border-t-4 border-gray-900">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 uppercase tracking-wide flex items-center">
                        <span class="w-3 h-3 bg-red-600 mr-3 block"></span>
                        Related Content
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <article class="group relative flex flex-col h-full cursor-pointer">
                                <a href="<?php echo e(route('article.show', [$article->page->slug ?? 'home', $article->slug])); ?>" class="absolute inset-0 z-10"><span class="sr-only">Read <?php echo e($article->title); ?></span></a>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->getFirstMediaUrl('featured_image')): ?>
                                    <div class="aspect-[16/9] overflow-hidden bg-gray-100 mb-4 border border-gray-100">
                                        <img
                                            src="<?php echo e($article->getFirstMediaUrl('featured_image', 'thumb')); ?>"
                                            alt="<?php echo e($article->title); ?>"
                                            loading="lazy"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                        >
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                <div class="flex flex-col flex-grow">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->category): ?>
                                        <span class="text-red-600 font-bold text-xs uppercase tracking-wider mb-2">
                                            <?php echo e($article->category->name); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2 group-hover:underline decoration-2 underline-offset-4">
                                        <?php echo e($article->title); ?>

                                    </h3>
                                    
                                    <time datetime="<?php echo e($article->published_at->toIso8601String()); ?>" class="text-sm text-gray-500 font-medium mt-auto pt-4">
                                        <?php echo e($article->published_at->diffForHumans()); ?>

                                    </time>
                                </div>
                            </article>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
        </main>
    </article>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/videos/show.blade.php ENDPATH**/ ?>
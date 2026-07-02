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
        </script>
    <?php $__env->stopPush(); ?>

    <div class="min-h-screen mx-auto text-slate-700 max-w-7xl text-slate-100">
        <header class="border-b border-white/5 backdrop-blur-lg">
            <div class="mx-auto max-w-[1600px] px-4 py-6 lg:px-8">
                <a href="<?php echo e(route('videos.index')); ?>" class="text-slate-400 hover:text-white transition-colors">
                    ← Back to Videos
                </a>
                <h1 class="text-3xl font-bold mt-4"><?php echo e($video->title); ?></h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->category): ?>
                    <span class="inline-block mt-2 text-sm px-3 py-1 rounded-full bg-white/5 text-slate-300">
                        <?php echo e($video->category->name); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-8 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->is_youtube && $video->youtube_id): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden bg-slate-900">
                            <iframe 
                                src="https://www.youtube.com/embed/<?php echo e($video->youtube_id); ?>" 
                                class="w-full h-full"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    <?php elseif($video->getFirstMediaUrl('local_video')): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden bg-slate-900">
                            <video 
                                controls 
                                class="w-full h-full"
                                poster="<?php echo e($video->getFirstMediaUrl('custom_thumbnail') ?? $video->getFirstMediaUrl('local_video', 'thumb')); ?>">
                                <source src="<?php echo e($video->getFirstMediaUrl('local_video')); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php else: ?>
                        <div class="aspect-video rounded-2xl bg-slate-900 flex items-center justify-center">
                            <span class="text-slate-500">Video not available</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-6">
                        <p class="text-slate-400 text-sm">
                            Published: <?php echo e($video->published_at->format('F j, Y g:i A')); ?>

                        </p>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-2xl border border-white/5 bg-slate-900 p-6">
                        <h3 class="font-bold mb-4">Share Video</h3>
                        <div class="flex gap-2">
                            <button class="flex-1 px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 transition-colors text-sm">
                                Copy Link
                            </button>
                        </div>
                    </div>
                </aside>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedArticles->count() > 0): ?>
                <div class="mt-12 border-t border-white/5 pt-8">
                    <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <a href="<?php echo e(route('article.show', [$article->page->slug ?? 'home', $article->slug])); ?>" class="group">
                                <div class="rounded-2xl overflow-hidden bg-slate-900 border border-white/5 hover:border-white/10 transition-all">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->getFirstMediaUrl('featured_image')): ?>
                                        <div class="aspect-video bg-slate-800">
                                            <img
                                                src="<?php echo e($article->getFirstMediaUrl('featured_image', 'thumb')); ?>"
                                                alt="<?php echo e($article->title); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            >
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-white group-hover:text-red-500 transition-colors line-clamp-2">
                                            <?php echo e($article->title); ?>

                                        </h3>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->category): ?>
                                            <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-white/5 text-slate-400">
                                                <?php echo e($article->category->name); ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <p class="text-xs text-slate-500 mt-2">
                                            <?php echo e($article->published_at->format('M j, Y')); ?>

                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </main>
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
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\videos\show.blade.php ENDPATH**/ ?>
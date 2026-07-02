<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Videos')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Videos'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="min-h-screen max-w-7xl mx-auto text-slate-700">
        <header class="border-b border-white/5  backdrop-blur-lg">
            <div class="mx-auto max-w-[1600px] py-6 ">
                <h1 class="text-3xl font-bold">Videos</h1>
                <p class="text-slate-400 mt-2">Browse all video content</p>
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] py-8 ">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($videos->count() > 0): ?>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('videos.show', $video->slug)); ?>" class="group">
                            <div class="overflow-hidden rounded-2xl bg-slate-900 border border-white/5 hover:border-white/10 transition-all">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->is_youtube && $video->youtube_id): ?>
                                    <div class="aspect-video bg-slate-800 relative">
                                        <img 
                                            src="https://img.youtube.com/vi/<?php echo e($video->youtube_id); ?>/hqdefault.jpg" 
                                            alt="<?php echo e($video->title); ?>"
                                            class="w-full h-full object-cover"
                                        >
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif($video->getFirstMediaUrl('local_video')): ?>
                                    <div class="aspect-video bg-slate-800 relative">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->getFirstMediaUrl('custom_thumbnail')): ?>
                                            <img 
                                                src="<?php echo e($video->getFirstMediaUrl('custom_thumbnail')); ?>" 
                                                alt="<?php echo e($video->title); ?>"
                                                class="w-full h-full object-cover"
                                            >
                                        <?php else: ?>
                                            <img 
                                                src="<?php echo e($video->getFirstMediaUrl('local_video', 'thumb')); ?>" 
                                                alt="<?php echo e($video->title); ?>"
                                                class="w-full h-full object-cover"
                                            >
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="aspect-video bg-slate-800 flex items-center justify-center">
                                        <span class="text-slate-500">No thumbnail</span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <div class="p-4">
                                    <h3 class="font-semibold text-white group-hover:text-red-500 transition-colors line-clamp-2">
                                        <?php echo e($video->title); ?>

                                    </h3>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->category): ?>
                                        <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-white/5 text-slate-400">
                                            <?php echo e($video->category->name); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <p class="text-xs text-slate-500 mt-2">
                                        <?php echo e($video->published_at->format('M j, Y')); ?>

                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <div class="mt-8 flex justify-center">
                    <?php echo e($videos->appends(request()->query())->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-slate-400">No videos found.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\videos\index.blade.php ENDPATH**/ ?>
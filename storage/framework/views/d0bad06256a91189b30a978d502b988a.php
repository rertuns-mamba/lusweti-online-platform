<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Lusweti-online-center'); ?></title>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    
    <livewire.frontend.google-analytics />
    <?php echo $__env->yieldContent('meta'); ?>
</head>

<body class="antialiased ">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! (request()->routeIs('home') || request()->is('/') || request()->routeIs('stream'))): ?>
        <?php if (isset($component)) { $__componentOriginal52356ccfc399747292104bf67c421150 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal52356ccfc399747292104bf67c421150 = $attributes; } ?>
<?php $component = App\View\Components\Frontend\Navbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Frontend\Navbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal52356ccfc399747292104bf67c421150)): ?>
<?php $attributes = $__attributesOriginal52356ccfc399747292104bf67c421150; ?>
<?php unset($__attributesOriginal52356ccfc399747292104bf67c421150); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal52356ccfc399747292104bf67c421150)): ?>
<?php $component = $__componentOriginal52356ccfc399747292104bf67c421150; ?>
<?php unset($__componentOriginal52356ccfc399747292104bf67c421150); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sections.breaking-news', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3872722820-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
    <main class="bg-[#fff]">
        <?php echo e($slot); ?>

    </main>

 

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! (request()->routeIs('home') || request()->is('/') || request()->routeIs('stream'))): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('frontend.global-page-footer', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3872722820-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script src="https://cdn.jsdelivr.net/npm/hls.js@1" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, Livewire:', typeof window.Livewire, 'Alpine:', typeof window.Alpine);

            // Bridge Alpine $dispatch events to Livewire
            window.addEventListener('open-auth-modal', function(e) {
                console.log('open-auth-modal event received', e.detail);
                if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                    window.Livewire.dispatch('open-auth-modal', e.detail || {});
                }
            });

            window.addEventListener('close-auth-modal', function(e) {
                console.log('close-auth-modal event received', e.detail);
                if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                    window.Livewire.dispatch('close-auth-modal', e.detail || {});
                }
            });
        });
    </script>
    <!-- TOGGLE LOGIC WITH SAFETY CHECKS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggler = document.getElementById('menu-toggler');
            const defaultNav = document.getElementById('default-nav');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Safety check: Only run if all three elements exist on the page
            if (menuToggler && defaultNav && dropdownMenu) {
                menuToggler.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');

                    if (dropdownMenu.classList.contains('hidden')) {
                        defaultNav.classList.remove('hidden');
                    } else {
                        defaultNav.classList.add('hidden');
                    }
                });
            } else {
                console.error('Menu toggler or navigation elements not found. Make sure IDs match.');
            }
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('article-preview-modal', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3872722820-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
</body>

</html>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\components\layouts\app.blade.php ENDPATH**/ ?>
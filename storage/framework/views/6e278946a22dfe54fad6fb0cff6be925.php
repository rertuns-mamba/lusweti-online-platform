<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sidebar' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'sidebar' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebar): ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/ec3bbd6ceef51c3c577b3a8065b9bda3.php'); ?>
<?php if (isset($__slotsec3bbd6ceef51c3c577b3a8065b9bda3)) { $__slotsStackec3bbd6ceef51c3c577b3a8065b9bda3[] = $__slotsec3bbd6ceef51c3c577b3a8065b9bda3; } ?>
<?php if (isset($__attrsec3bbd6ceef51c3c577b3a8065b9bda3)) { $__attrsStackec3bbd6ceef51c3c577b3a8065b9bda3[] = $__attrsec3bbd6ceef51c3c577b3a8065b9bda3; } ?>
<?php $__attrsec3bbd6ceef51c3c577b3a8065b9bda3 = ['name' => 'Laravel Starter Kit','attributes' => $attributes]; ?>
<?php $__slotsec3bbd6ceef51c3c577b3a8065b9bda3 = []; ?>
<?php $__blaze->pushData($__attrsec3bbd6ceef51c3c577b3a8065b9bda3); ?>
<?php ob_start(); ?>
             <?php $__slotsec3bbd6ceef51c3c577b3a8065b9bda3['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slotsec3bbd6ceef51c3c577b3a8065b9bda3['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
<?php $__blaze->pushSlots($__slotsec3bbd6ceef51c3c577b3a8065b9bda3); ?>
<?php _ec3bbd6ceef51c3c577b3a8065b9bda3($__blaze, $__attrsec3bbd6ceef51c3c577b3a8065b9bda3, $__slotsec3bbd6ceef51c3c577b3a8065b9bda3, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackec3bbd6ceef51c3c577b3a8065b9bda3)) { $__slotsec3bbd6ceef51c3c577b3a8065b9bda3 = array_pop($__slotsStackec3bbd6ceef51c3c577b3a8065b9bda3); } ?>
<?php if (! empty($__attrsStackec3bbd6ceef51c3c577b3a8065b9bda3)) { $__attrsec3bbd6ceef51c3c577b3a8065b9bda3 = array_pop($__attrsStackec3bbd6ceef51c3c577b3a8065b9bda3); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/brand.blade.php', $__blaze->compiledPath.'/f58883998a4fd7db96a2fadf7b010f45.php'); ?>
<?php if (isset($__slotsf58883998a4fd7db96a2fadf7b010f45)) { $__slotsStackf58883998a4fd7db96a2fadf7b010f45[] = $__slotsf58883998a4fd7db96a2fadf7b010f45; } ?>
<?php if (isset($__attrsf58883998a4fd7db96a2fadf7b010f45)) { $__attrsStackf58883998a4fd7db96a2fadf7b010f45[] = $__attrsf58883998a4fd7db96a2fadf7b010f45; } ?>
<?php $__attrsf58883998a4fd7db96a2fadf7b010f45 = ['name' => 'Laravel Starter Kit','attributes' => $attributes]; ?>
<?php $__slotsf58883998a4fd7db96a2fadf7b010f45 = []; ?>
<?php $__blaze->pushData($__attrsf58883998a4fd7db96a2fadf7b010f45); ?>
<?php ob_start(); ?>
             <?php $__slotsf58883998a4fd7db96a2fadf7b010f45['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slotsf58883998a4fd7db96a2fadf7b010f45['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
<?php $__blaze->pushSlots($__slotsf58883998a4fd7db96a2fadf7b010f45); ?>
<?php _f58883998a4fd7db96a2fadf7b010f45($__blaze, $__attrsf58883998a4fd7db96a2fadf7b010f45, $__slotsf58883998a4fd7db96a2fadf7b010f45, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf58883998a4fd7db96a2fadf7b010f45)) { $__slotsf58883998a4fd7db96a2fadf7b010f45 = array_pop($__slotsStackf58883998a4fd7db96a2fadf7b010f45); } ?>
<?php if (! empty($__attrsStackf58883998a4fd7db96a2fadf7b010f45)) { $__attrsf58883998a4fd7db96a2fadf7b010f45 = array_pop($__attrsStackf58883998a4fd7db96a2fadf7b010f45); } ?>
<?php $__blaze->popData(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\components\app-logo.blade.php ENDPATH**/ ?>
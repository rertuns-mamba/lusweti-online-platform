<?php
if (!function_exists('_c98fdc41a3d6c666c6aa192b7d2e3a0a')):
function _c98fdc41a3d6c666c6aa192b7d2e3a0a($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$classes = Flux::classes('[grid-area:footer]')
    ->add($attributes->has('container') ? '' : 'p-6 lg:p-8')
    ;
?>

<div <?php echo e($attributes->class($classes)); ?> data-flux-footer>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/with-container.blade.php', $__blaze->compiledPath.'/538dfbf426294788618e90bbde5bde47.php'); ?>
<?php if (isset($__slots538dfbf426294788618e90bbde5bde47)) { $__slotsStack538dfbf426294788618e90bbde5bde47[] = $__slots538dfbf426294788618e90bbde5bde47; } ?>
<?php if (isset($__attrs538dfbf426294788618e90bbde5bde47)) { $__attrsStack538dfbf426294788618e90bbde5bde47[] = $__attrs538dfbf426294788618e90bbde5bde47; } ?>
<?php $__attrs538dfbf426294788618e90bbde5bde47 = ['attributes' => $attributes->except('class')->class('p-6 lg:p-8')]; ?>
<?php $__slots538dfbf426294788618e90bbde5bde47 = []; ?>
<?php $__blaze->pushData($__attrs538dfbf426294788618e90bbde5bde47); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slots538dfbf426294788618e90bbde5bde47['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots538dfbf426294788618e90bbde5bde47); ?>
<?php _538dfbf426294788618e90bbde5bde47($__blaze, $__attrs538dfbf426294788618e90bbde5bde47, $__slots538dfbf426294788618e90bbde5bde47, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack538dfbf426294788618e90bbde5bde47)) { $__slots538dfbf426294788618e90bbde5bde47 = array_pop($__slotsStack538dfbf426294788618e90bbde5bde47); } ?>
<?php if (! empty($__attrsStack538dfbf426294788618e90bbde5bde47)) { $__attrs538dfbf426294788618e90bbde5bde47 = array_pop($__attrsStack538dfbf426294788618e90bbde5bde47); } ?>
<?php $__blaze->popData(); ?>
</div>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\footer.blade.php ENDPATH**/ ?>
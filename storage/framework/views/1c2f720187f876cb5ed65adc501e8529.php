<?php
if (!function_exists('_1c2f720187f876cb5ed65adc501e8529')):
function _1c2f720187f876cb5ed65adc501e8529($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
$__defaults = [
    'variant' => null,
    'size' => null,
    'name' => null,
];
$variant ??= $attributes['variant'] ?? $__defaults['variant']; unset($attributes['variant']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
unset($__defaults);
?>

<?php
// We only want to show the name attribute on the checkbox if it has been set
// manually, but not if it has been set from the wire:model attribute...
$showName = isset($name);

if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

$classes = Flux::classes()
    ->add('flex flex-wrap gap-2')
    ;
?>

<?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/a5c6e5fda80b04d88790f8e3a794985d.php'); ?>
<?php if (isset($__slotsa5c6e5fda80b04d88790f8e3a794985d)) { $__slotsStacka5c6e5fda80b04d88790f8e3a794985d[] = $__slotsa5c6e5fda80b04d88790f8e3a794985d; } ?>
<?php if (isset($__attrsa5c6e5fda80b04d88790f8e3a794985d)) { $__attrsStacka5c6e5fda80b04d88790f8e3a794985d[] = $__attrsa5c6e5fda80b04d88790f8e3a794985d; } ?>
<?php $__attrsa5c6e5fda80b04d88790f8e3a794985d = ['attributes' => $attributes]; ?>
<?php $__slotsa5c6e5fda80b04d88790f8e3a794985d = []; ?>
<?php $__blaze->pushData($__attrsa5c6e5fda80b04d88790f8e3a794985d); ?>
<?php ob_start(); ?>
    <ui-checkbox-group <?php echo e($attributes->class($classes)); ?> <?php if($showName): ?> name="<?php echo e($name); ?>" <?php endif; ?> data-flux-checkbox-group-buttons>
        <?php echo e($slot); ?>

    </ui-checkbox-group>
<?php $__slotsa5c6e5fda80b04d88790f8e3a794985d['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsa5c6e5fda80b04d88790f8e3a794985d); ?>
<?php _a5c6e5fda80b04d88790f8e3a794985d($__blaze, $__attrsa5c6e5fda80b04d88790f8e3a794985d, $__slotsa5c6e5fda80b04d88790f8e3a794985d, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacka5c6e5fda80b04d88790f8e3a794985d)) { $__slotsa5c6e5fda80b04d88790f8e3a794985d = array_pop($__slotsStacka5c6e5fda80b04d88790f8e3a794985d); } ?>
<?php if (! empty($__attrsStacka5c6e5fda80b04d88790f8e3a794985d)) { $__attrsa5c6e5fda80b04d88790f8e3a794985d = array_pop($__attrsStacka5c6e5fda80b04d88790f8e3a794985d); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\checkbox\group\variants\buttons.blade.php ENDPATH**/ ?>
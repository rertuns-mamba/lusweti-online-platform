<?php
if (!function_exists('__646b95bbc19f8f3f9733f4cf5a7bc4ab')):
function __646b95bbc19f8f3f9733f4cf5a7bc4ab($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/cf92fc35eedf4d37517af7513850065c.php'); ?>
<?php if (isset($__slotscf92fc35eedf4d37517af7513850065c)) { $__slotsStackcf92fc35eedf4d37517af7513850065c[] = $__slotscf92fc35eedf4d37517af7513850065c; } ?>
<?php if (isset($__attrscf92fc35eedf4d37517af7513850065c)) { $__attrsStackcf92fc35eedf4d37517af7513850065c[] = $__attrscf92fc35eedf4d37517af7513850065c; } ?>
<?php $__attrscf92fc35eedf4d37517af7513850065c = ['kbd' => $kbd]; ?>
<?php $__slotscf92fc35eedf4d37517af7513850065c = []; ?>
<?php $__blaze->pushData($__attrscf92fc35eedf4d37517af7513850065c); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotscf92fc35eedf4d37517af7513850065c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotscf92fc35eedf4d37517af7513850065c); ?>
<?php __cf92fc35eedf4d37517af7513850065c($__blaze, $__attrscf92fc35eedf4d37517af7513850065c, $__slotscf92fc35eedf4d37517af7513850065c, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackcf92fc35eedf4d37517af7513850065c)) { $__slotscf92fc35eedf4d37517af7513850065c = array_pop($__slotsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php if (! empty($__attrsStackcf92fc35eedf4d37517af7513850065c)) { $__attrscf92fc35eedf4d37517af7513850065c = array_pop($__attrsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/cf92fc35eedf4d37517af7513850065c.php'); ?>
<?php if (isset($__slotscf92fc35eedf4d37517af7513850065c)) { $__slotsStackcf92fc35eedf4d37517af7513850065c[] = $__slotscf92fc35eedf4d37517af7513850065c; } ?>
<?php if (isset($__attrscf92fc35eedf4d37517af7513850065c)) { $__attrsStackcf92fc35eedf4d37517af7513850065c[] = $__attrscf92fc35eedf4d37517af7513850065c; } ?>
<?php $__attrscf92fc35eedf4d37517af7513850065c = ['kbd' => $kbd]; ?>
<?php $__slotscf92fc35eedf4d37517af7513850065c = []; ?>
<?php $__blaze->pushData($__attrscf92fc35eedf4d37517af7513850065c); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotscf92fc35eedf4d37517af7513850065c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotscf92fc35eedf4d37517af7513850065c); ?>
<?php __cf92fc35eedf4d37517af7513850065c($__blaze, $__attrscf92fc35eedf4d37517af7513850065c, $__slotscf92fc35eedf4d37517af7513850065c, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackcf92fc35eedf4d37517af7513850065c)) { $__slotscf92fc35eedf4d37517af7513850065c = array_pop($__slotsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php if (! empty($__attrsStackcf92fc35eedf4d37517af7513850065c)) { $__attrscf92fc35eedf4d37517af7513850065c = array_pop($__attrsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>
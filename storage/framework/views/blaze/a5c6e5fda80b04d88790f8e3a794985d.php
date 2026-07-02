<?php
if (!function_exists('__a5c6e5fda80b04d88790f8e3a794985d')):
function __a5c6e5fda80b04d88790f8e3a794985d($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
extract(Flux::forwardedAttributes($attributes, [
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/6a8a129e8cd55782099a29215785b823.php'); ?>
<?php if (isset($__slots6a8a129e8cd55782099a29215785b823)) { $__slotsStack6a8a129e8cd55782099a29215785b823[] = $__slots6a8a129e8cd55782099a29215785b823; } ?>
<?php if (isset($__attrs6a8a129e8cd55782099a29215785b823)) { $__attrsStack6a8a129e8cd55782099a29215785b823[] = $__attrs6a8a129e8cd55782099a29215785b823; } ?>
<?php $__attrs6a8a129e8cd55782099a29215785b823 = ['attributes' => $fieldAttributes]; ?>
<?php $__slots6a8a129e8cd55782099a29215785b823 = []; ?>
<?php $__blaze->pushData($__attrs6a8a129e8cd55782099a29215785b823); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/b1608d23ae24763e292ace789f9492e8.php'); ?>
<?php if (isset($__slotsb1608d23ae24763e292ace789f9492e8)) { $__slotsStackb1608d23ae24763e292ace789f9492e8[] = $__slotsb1608d23ae24763e292ace789f9492e8; } ?>
<?php if (isset($__attrsb1608d23ae24763e292ace789f9492e8)) { $__attrsStackb1608d23ae24763e292ace789f9492e8[] = $__attrsb1608d23ae24763e292ace789f9492e8; } ?>
<?php $__attrsb1608d23ae24763e292ace789f9492e8 = ['attributes' => $labelAttributes]; ?>
<?php $__slotsb1608d23ae24763e292ace789f9492e8 = []; ?>
<?php $__blaze->pushData($__attrsb1608d23ae24763e292ace789f9492e8); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slotsb1608d23ae24763e292ace789f9492e8['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsb1608d23ae24763e292ace789f9492e8); ?>
<?php __b1608d23ae24763e292ace789f9492e8($__blaze, $__attrsb1608d23ae24763e292ace789f9492e8, $__slotsb1608d23ae24763e292ace789f9492e8, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb1608d23ae24763e292ace789f9492e8)) { $__slotsb1608d23ae24763e292ace789f9492e8 = array_pop($__slotsStackb1608d23ae24763e292ace789f9492e8); } ?>
<?php if (! empty($__attrsStackb1608d23ae24763e292ace789f9492e8)) { $__attrsb1608d23ae24763e292ace789f9492e8 = array_pop($__attrsStackb1608d23ae24763e292ace789f9492e8); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/01ff82d895d944da3dc1d5e8a87ad469.php'); ?>
<?php if (isset($__slots01ff82d895d944da3dc1d5e8a87ad469)) { $__slotsStack01ff82d895d944da3dc1d5e8a87ad469[] = $__slots01ff82d895d944da3dc1d5e8a87ad469; } ?>
<?php if (isset($__attrs01ff82d895d944da3dc1d5e8a87ad469)) { $__attrsStack01ff82d895d944da3dc1d5e8a87ad469[] = $__attrs01ff82d895d944da3dc1d5e8a87ad469; } ?>
<?php $__attrs01ff82d895d944da3dc1d5e8a87ad469 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots01ff82d895d944da3dc1d5e8a87ad469 = []; ?>
<?php $__blaze->pushData($__attrs01ff82d895d944da3dc1d5e8a87ad469); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slots01ff82d895d944da3dc1d5e8a87ad469['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots01ff82d895d944da3dc1d5e8a87ad469); ?>
<?php __01ff82d895d944da3dc1d5e8a87ad469($__blaze, $__attrs01ff82d895d944da3dc1d5e8a87ad469, $__slots01ff82d895d944da3dc1d5e8a87ad469, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack01ff82d895d944da3dc1d5e8a87ad469)) { $__slots01ff82d895d944da3dc1d5e8a87ad469 = array_pop($__slotsStack01ff82d895d944da3dc1d5e8a87ad469); } ?>
<?php if (! empty($__attrsStack01ff82d895d944da3dc1d5e8a87ad469)) { $__attrs01ff82d895d944da3dc1d5e8a87ad469 = array_pop($__attrsStack01ff82d895d944da3dc1d5e8a87ad469); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        [STARTCOMPILEDUNBLAZE:FCmE7I6tc7]<?php \Livewire\Blaze\Unblaze::storeScope("FCmE7I6tc7", scope: ['attributes' => $errorAttributes->getAttributes()]) ?>[ENDCOMPILEDUNBLAZE:FCmE7I6tc7]

        <?php if (isset($descriptionTrailing)): ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/01ff82d895d944da3dc1d5e8a87ad469.php'); ?>
<?php if (isset($__slots01ff82d895d944da3dc1d5e8a87ad469)) { $__slotsStack01ff82d895d944da3dc1d5e8a87ad469[] = $__slots01ff82d895d944da3dc1d5e8a87ad469; } ?>
<?php if (isset($__attrs01ff82d895d944da3dc1d5e8a87ad469)) { $__attrsStack01ff82d895d944da3dc1d5e8a87ad469[] = $__attrs01ff82d895d944da3dc1d5e8a87ad469; } ?>
<?php $__attrs01ff82d895d944da3dc1d5e8a87ad469 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots01ff82d895d944da3dc1d5e8a87ad469 = []; ?>
<?php $__blaze->pushData($__attrs01ff82d895d944da3dc1d5e8a87ad469); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slots01ff82d895d944da3dc1d5e8a87ad469['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots01ff82d895d944da3dc1d5e8a87ad469); ?>
<?php __01ff82d895d944da3dc1d5e8a87ad469($__blaze, $__attrs01ff82d895d944da3dc1d5e8a87ad469, $__slots01ff82d895d944da3dc1d5e8a87ad469, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack01ff82d895d944da3dc1d5e8a87ad469)) { $__slots01ff82d895d944da3dc1d5e8a87ad469 = array_pop($__slotsStack01ff82d895d944da3dc1d5e8a87ad469); } ?>
<?php if (! empty($__attrsStack01ff82d895d944da3dc1d5e8a87ad469)) { $__attrs01ff82d895d944da3dc1d5e8a87ad469 = array_pop($__attrsStack01ff82d895d944da3dc1d5e8a87ad469); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots6a8a129e8cd55782099a29215785b823['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots6a8a129e8cd55782099a29215785b823); ?>
<?php __6a8a129e8cd55782099a29215785b823($__blaze, $__attrs6a8a129e8cd55782099a29215785b823, $__slots6a8a129e8cd55782099a29215785b823, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack6a8a129e8cd55782099a29215785b823)) { $__slots6a8a129e8cd55782099a29215785b823 = array_pop($__slotsStack6a8a129e8cd55782099a29215785b823); } ?>
<?php if (! empty($__attrsStack6a8a129e8cd55782099a29215785b823)) { $__attrs6a8a129e8cd55782099a29215785b823 = array_pop($__attrsStack6a8a129e8cd55782099a29215785b823); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>
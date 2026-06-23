<?php
if (!function_exists('__584419564efcb469bd59843bbbc26a1d')):
function __584419564efcb469bd59843bbbc26a1d($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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

<?php if (isset($label) || isset($description)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/616bffa155a64c65c86c9ea89b094b80.php'); ?>
<?php if (isset($__slots616bffa155a64c65c86c9ea89b094b80)) { $__slotsStack616bffa155a64c65c86c9ea89b094b80[] = $__slots616bffa155a64c65c86c9ea89b094b80; } ?>
<?php if (isset($__attrs616bffa155a64c65c86c9ea89b094b80)) { $__attrsStack616bffa155a64c65c86c9ea89b094b80[] = $__attrs616bffa155a64c65c86c9ea89b094b80; } ?>
<?php $__attrs616bffa155a64c65c86c9ea89b094b80 = ['attributes' => $fieldAttributes]; ?>
<?php $__slots616bffa155a64c65c86c9ea89b094b80 = []; ?>
<?php $__blaze->pushData($__attrs616bffa155a64c65c86c9ea89b094b80); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/81778e25a77397579620147824b63d79.php'); ?>
<?php if (isset($__slots81778e25a77397579620147824b63d79)) { $__slotsStack81778e25a77397579620147824b63d79[] = $__slots81778e25a77397579620147824b63d79; } ?>
<?php if (isset($__attrs81778e25a77397579620147824b63d79)) { $__attrsStack81778e25a77397579620147824b63d79[] = $__attrs81778e25a77397579620147824b63d79; } ?>
<?php $__attrs81778e25a77397579620147824b63d79 = ['attributes' => $labelAttributes]; ?>
<?php $__slots81778e25a77397579620147824b63d79 = []; ?>
<?php $__blaze->pushData($__attrs81778e25a77397579620147824b63d79); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slots81778e25a77397579620147824b63d79['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots81778e25a77397579620147824b63d79); ?>
<?php __81778e25a77397579620147824b63d79($__blaze, $__attrs81778e25a77397579620147824b63d79, $__slots81778e25a77397579620147824b63d79, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack81778e25a77397579620147824b63d79)) { $__slots81778e25a77397579620147824b63d79 = array_pop($__slotsStack81778e25a77397579620147824b63d79); } ?>
<?php if (! empty($__attrsStack81778e25a77397579620147824b63d79)) { $__attrs81778e25a77397579620147824b63d79 = array_pop($__attrsStack81778e25a77397579620147824b63d79); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/4e309e8692eb430d4ea8c9469b18e14c.php'); ?>
<?php if (isset($__slots4e309e8692eb430d4ea8c9469b18e14c)) { $__slotsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__slots4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php if (isset($__attrs4e309e8692eb430d4ea8c9469b18e14c)) { $__attrsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__attrs4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php $__attrs4e309e8692eb430d4ea8c9469b18e14c = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots4e309e8692eb430d4ea8c9469b18e14c = []; ?>
<?php $__blaze->pushData($__attrs4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slots4e309e8692eb430d4ea8c9469b18e14c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php __4e309e8692eb430d4ea8c9469b18e14c($__blaze, $__attrs4e309e8692eb430d4ea8c9469b18e14c, $__slots4e309e8692eb430d4ea8c9469b18e14c, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__slots4e309e8692eb430d4ea8c9469b18e14c = array_pop($__slotsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php if (! empty($__attrsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__attrs4e309e8692eb430d4ea8c9469b18e14c = array_pop($__attrsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        [STARTCOMPILEDUNBLAZE:e3MfjX8HPh]<?php \Livewire\Blaze\Unblaze::storeScope("e3MfjX8HPh", scope: ['attributes' => $errorAttributes->getAttributes()]) ?>[ENDCOMPILEDUNBLAZE:e3MfjX8HPh]

        <?php if (isset($descriptionTrailing)): ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/4e309e8692eb430d4ea8c9469b18e14c.php'); ?>
<?php if (isset($__slots4e309e8692eb430d4ea8c9469b18e14c)) { $__slotsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__slots4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php if (isset($__attrs4e309e8692eb430d4ea8c9469b18e14c)) { $__attrsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__attrs4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php $__attrs4e309e8692eb430d4ea8c9469b18e14c = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots4e309e8692eb430d4ea8c9469b18e14c = []; ?>
<?php $__blaze->pushData($__attrs4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slots4e309e8692eb430d4ea8c9469b18e14c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php __4e309e8692eb430d4ea8c9469b18e14c($__blaze, $__attrs4e309e8692eb430d4ea8c9469b18e14c, $__slots4e309e8692eb430d4ea8c9469b18e14c, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__slots4e309e8692eb430d4ea8c9469b18e14c = array_pop($__slotsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php if (! empty($__attrsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__attrs4e309e8692eb430d4ea8c9469b18e14c = array_pop($__attrsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots616bffa155a64c65c86c9ea89b094b80['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots616bffa155a64c65c86c9ea89b094b80); ?>
<?php __616bffa155a64c65c86c9ea89b094b80($__blaze, $__attrs616bffa155a64c65c86c9ea89b094b80, $__slots616bffa155a64c65c86c9ea89b094b80, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack616bffa155a64c65c86c9ea89b094b80)) { $__slots616bffa155a64c65c86c9ea89b094b80 = array_pop($__slotsStack616bffa155a64c65c86c9ea89b094b80); } ?>
<?php if (! empty($__attrsStack616bffa155a64c65c86c9ea89b094b80)) { $__attrs616bffa155a64c65c86c9ea89b094b80 = array_pop($__attrsStack616bffa155a64c65c86c9ea89b094b80); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>
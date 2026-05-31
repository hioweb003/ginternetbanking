<?php
if (!function_exists('__ba90bee36eee13795633d2abcb6b5380')):
function __ba90bee36eee13795633d2abcb6b5380($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'legend' => null,
    'description' => null,
];
$legend ??= $attributes['legend'] ?? $__defaults['legend']; unset($attributes['legend']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
unset($__defaults);
?>

<?php
$classes = Flux::classes()
    ->add('[&[disabled]_[data-flux-label]]:opacity-50') // Dim labels when the fieldset is disabled...
    ->add('[&[disabled]_[data-flux-legend]]:opacity-50') // Dim legend when the fieldset is disabled...

    // Adjust spacing between fields...
    ->add('*:data-flux-field:mb-3')

    // Adjust spacing between fields...
    ->add('*:data-flux-field:mb-3')
    ->add('[&>[data-flux-field]:has(>[data-flux-description])]:mb-4')
    ->add('[&>[data-flux-field]:last-child]:mb-0!')

    // Adjust spacing below legend...
    ->add('[&>[data-flux-legend]]:mb-4')
    ->add('[&>[data-flux-legend]:has(+[data-flux-description])]:mb-2')

    // Adjust spacing below description...
    ->add('[&>[data-flux-legend]+[data-flux-description]]:mb-4')
    ;
?>

<fieldset <?php echo e($attributes->class($classes)); ?> data-flux-fieldset>
    <?php if ($legend): ?>
        <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/legend.blade.php', $__blaze->compiledPath.'/c87e3c821c612af00715716aaacccf10.php'); ?>
<?php if (isset($__slotsc87e3c821c612af00715716aaacccf10)) { $__slotsStackc87e3c821c612af00715716aaacccf10[] = $__slotsc87e3c821c612af00715716aaacccf10; } ?>
<?php if (isset($__attrsc87e3c821c612af00715716aaacccf10)) { $__attrsStackc87e3c821c612af00715716aaacccf10[] = $__attrsc87e3c821c612af00715716aaacccf10; } ?>
<?php $__attrsc87e3c821c612af00715716aaacccf10 = []; ?>
<?php $__slotsc87e3c821c612af00715716aaacccf10 = []; ?>
<?php $__blaze->pushData($__attrsc87e3c821c612af00715716aaacccf10); ?>
<?php ob_start(); ?><?php echo e($legend); ?><?php $__slotsc87e3c821c612af00715716aaacccf10['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsc87e3c821c612af00715716aaacccf10); ?>
<?php __c87e3c821c612af00715716aaacccf10($__blaze, $__attrsc87e3c821c612af00715716aaacccf10, $__slotsc87e3c821c612af00715716aaacccf10, [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackc87e3c821c612af00715716aaacccf10)) { $__slotsc87e3c821c612af00715716aaacccf10 = array_pop($__slotsStackc87e3c821c612af00715716aaacccf10); } ?>
<?php if (! empty($__attrsStackc87e3c821c612af00715716aaacccf10)) { $__attrsc87e3c821c612af00715716aaacccf10 = array_pop($__attrsStackc87e3c821c612af00715716aaacccf10); } ?>
<?php $__blaze->popData(); ?>
    <?php endif; ?>

    <?php if ($description): ?>
        <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/4e309e8692eb430d4ea8c9469b18e14c.php'); ?>
<?php if (isset($__slots4e309e8692eb430d4ea8c9469b18e14c)) { $__slotsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__slots4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php if (isset($__attrs4e309e8692eb430d4ea8c9469b18e14c)) { $__attrsStack4e309e8692eb430d4ea8c9469b18e14c[] = $__attrs4e309e8692eb430d4ea8c9469b18e14c; } ?>
<?php $__attrs4e309e8692eb430d4ea8c9469b18e14c = []; ?>
<?php $__slots4e309e8692eb430d4ea8c9469b18e14c = []; ?>
<?php $__blaze->pushData($__attrs4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slots4e309e8692eb430d4ea8c9469b18e14c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots4e309e8692eb430d4ea8c9469b18e14c); ?>
<?php __4e309e8692eb430d4ea8c9469b18e14c($__blaze, $__attrs4e309e8692eb430d4ea8c9469b18e14c, $__slots4e309e8692eb430d4ea8c9469b18e14c, [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__slots4e309e8692eb430d4ea8c9469b18e14c = array_pop($__slotsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php if (! empty($__attrsStack4e309e8692eb430d4ea8c9469b18e14c)) { $__attrs4e309e8692eb430d4ea8c9469b18e14c = array_pop($__attrsStack4e309e8692eb430d4ea8c9469b18e14c); } ?>
<?php $__blaze->popData(); ?>
    <?php endif; ?>

    <?php echo e($slot); ?>

</fieldset>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/fieldset.blade.php ENDPATH**/ ?>
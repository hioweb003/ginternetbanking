<?php
if (!function_exists('_8a017fd6d6d9cec25d1ac50ebd17ed8f')):
function _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>
<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'right',
    'tooltipKbd' => null,
    'tooltip' => null,
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$badgeColor ??= $attributes['badge-color'] ?? $attributes['badgeColor'] ?? $__defaults['badgeColor']; unset($attributes['badgeColor'], $attributes['badge-color']);
$iconDot ??= $attributes['icon-dot'] ?? $attributes['iconDot'] ?? $__defaults['iconDot']; unset($attributes['iconDot'], $attributes['icon-dot']);
$accent ??= $attributes['accent'] ?? $__defaults['accent']; unset($attributes['accent']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php
$tooltip ??= $slot->isNotEmpty() ? (string) $slot : null;

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes('size-4')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-400! dark:in-data-flux-sidebar-group-dropdown:text-white/80!')
    ->add('[[data-flux-sidebar-item]:hover_&]:text-current!');

$classes = Flux::classes()
    ->add('h-8 in-data-flux-sidebar-on-mobile:h-10 relative flex items-center gap-3 rounded-lg')
    ->add('in-data-flux-sidebar-collapsed-desktop:w-10 in-data-flux-sidebar-collapsed-desktop:justify-center')
    ->add('py-0 text-start w-full px-3 has-data-flux-navlist-badge:not-in-data-flux-sidebar-collapsed-desktop:pe-1.5 my-px')
    ->add('text-zinc-500 dark:text-white/80')
    ->add(match ($accent) {
        true => [
            'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
            'data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent',
            'hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5 ',
            'border border-transparent',
        ],
        false => [
            'data-current:text-zinc-800 dark:data-current:text-zinc-100 data-current:border-zinc-200',
            'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-zinc-200 dark:data-current:border-white/10 data-current:shadow-xs',
            'hover:text-zinc-800 dark:hover:text-white',
        ],
    })
    // Override the default styles to match dropdowns for when the item is inside a collapsed group dropdown...
    ->add('in-data-flux-sidebar-group-dropdown:w-auto! in-data-flux-sidebar-group-dropdown:px-2!')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-800! in-data-flux-sidebar-group-dropdown:bg-white! in-data-flux-sidebar-group-dropdown:hover:bg-zinc-50!')
    ->add('dark:in-data-flux-sidebar-group-dropdown:text-white! dark:in-data-flux-sidebar-group-dropdown:bg-transparent! dark:in-data-flux-sidebar-group-dropdown:hover:bg-zinc-600!')
    ;
?>

<?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/1677c28325f5b2e4c1307da836953e0c.php'); ?>
<?php if (isset($__slots1677c28325f5b2e4c1307da836953e0c)) { $__slotsStack1677c28325f5b2e4c1307da836953e0c[] = $__slots1677c28325f5b2e4c1307da836953e0c; } ?>
<?php if (isset($__attrs1677c28325f5b2e4c1307da836953e0c)) { $__attrsStack1677c28325f5b2e4c1307da836953e0c[] = $__attrs1677c28325f5b2e4c1307da836953e0c; } ?>
<?php $__attrs1677c28325f5b2e4c1307da836953e0c = ['position' => $tooltipPosition]; ?>
<?php $__slots1677c28325f5b2e4c1307da836953e0c = []; ?>
<?php $__blaze->pushData($__attrs1677c28325f5b2e4c1307da836953e0c); ?>
<?php ob_start(); ?>
    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/button-or-link.blade.php', $__blaze->compiledPath.'/d8ca38391d0d24a699f73e86c93898c3.php'); ?>
<?php if (isset($__slotsd8ca38391d0d24a699f73e86c93898c3)) { $__slotsStackd8ca38391d0d24a699f73e86c93898c3[] = $__slotsd8ca38391d0d24a699f73e86c93898c3; } ?>
<?php if (isset($__attrsd8ca38391d0d24a699f73e86c93898c3)) { $__attrsStackd8ca38391d0d24a699f73e86c93898c3[] = $__attrsd8ca38391d0d24a699f73e86c93898c3; } ?>
<?php $__attrsd8ca38391d0d24a699f73e86c93898c3 = ['attributes' => $attributes->class($classes),'dataFluxSidebarItem' => true]; ?>
<?php $__slotsd8ca38391d0d24a699f73e86c93898c3 = []; ?>
<?php $__blaze->pushData($__attrsd8ca38391d0d24a699f73e86c93898c3); ?>
<?php ob_start(); ?>
        <?php if ($icon): ?>
            <div class="relative">
                <?php if (is_string($icon) && $icon !== ''): ?>
                    <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => $iconClasses]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/1076136291a468841f5527c710e431e9.php'); ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php _1076136291a468841f5527c710e431e9($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                <?php else: ?>
                    <?php echo e($icon); ?>

                <?php endif; ?>

                <?php if ($iconDot): ?>
                    <div class="absolute top-[-2px] end-[-2px]">
                        <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($slot->isNotEmpty()): ?>
            <div class="
                in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden
                flex-1 text-sm font-medium truncate [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content><?php echo e($slot); ?></div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/1076136291a468841f5527c710e431e9.php'); ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?>
<?php _1076136291a468841f5527c710e431e9($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
        <?php elseif ($iconTrailing): ?>
            <?php echo e($iconTrailing); ?>

        <?php endif; ?>

        <?php if (isset($badge) && $badge !== ''): ?>
            <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/navlist/badge.blade.php', $__blaze->compiledPath.'/c7a7853101dc329187c201161285421e.php'); ?>
<?php if (isset($__slotsc7a7853101dc329187c201161285421e)) { $__slotsStackc7a7853101dc329187c201161285421e[] = $__slotsc7a7853101dc329187c201161285421e; } ?>
<?php if (isset($__attrsc7a7853101dc329187c201161285421e)) { $__attrsStackc7a7853101dc329187c201161285421e[] = $__attrsc7a7853101dc329187c201161285421e; } ?>
<?php $__attrsc7a7853101dc329187c201161285421e = ['attributes' => $badgeAttributes,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden']; ?>
<?php $__slotsc7a7853101dc329187c201161285421e = []; ?>
<?php $__blaze->pushData($__attrsc7a7853101dc329187c201161285421e); ?>
<?php ob_start(); ?><?php echo e($badge); ?><?php $__slotsc7a7853101dc329187c201161285421e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsc7a7853101dc329187c201161285421e); ?>
<?php _c7a7853101dc329187c201161285421e($__blaze, $__attrsc7a7853101dc329187c201161285421e, $__slotsc7a7853101dc329187c201161285421e, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackc7a7853101dc329187c201161285421e)) { $__slotsc7a7853101dc329187c201161285421e = array_pop($__slotsStackc7a7853101dc329187c201161285421e); } ?>
<?php if (! empty($__attrsStackc7a7853101dc329187c201161285421e)) { $__attrsc7a7853101dc329187c201161285421e = array_pop($__attrsStackc7a7853101dc329187c201161285421e); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slotsd8ca38391d0d24a699f73e86c93898c3['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsd8ca38391d0d24a699f73e86c93898c3); ?>
<?php _d8ca38391d0d24a699f73e86c93898c3($__blaze, $__attrsd8ca38391d0d24a699f73e86c93898c3, $__slotsd8ca38391d0d24a699f73e86c93898c3, ['attributes', 'dataFluxSidebarItem'], ['dataFluxSidebarItem' => 'data-flux-sidebar-item'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackd8ca38391d0d24a699f73e86c93898c3)) { $__slotsd8ca38391d0d24a699f73e86c93898c3 = array_pop($__slotsStackd8ca38391d0d24a699f73e86c93898c3); } ?>
<?php if (! empty($__attrsStackd8ca38391d0d24a699f73e86c93898c3)) { $__attrsd8ca38391d0d24a699f73e86c93898c3 = array_pop($__attrsStackd8ca38391d0d24a699f73e86c93898c3); } ?>
<?php $__blaze->popData(); ?>

    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/a3135de46300f669a9a8e42bedbaf8ae.php'); ?>
<?php if (isset($__slotsa3135de46300f669a9a8e42bedbaf8ae)) { $__slotsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__slotsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php if (isset($__attrsa3135de46300f669a9a8e42bedbaf8ae)) { $__attrsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__attrsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php $__attrsa3135de46300f669a9a8e42bedbaf8ae = ['kbd' => $tooltipKbd,'class' => 'not-in-data-flux-sidebar-collapsed-desktop:hidden in-data-flux-sidebar-group-dropdown:hidden cursor-default']; ?>
<?php $__slotsa3135de46300f669a9a8e42bedbaf8ae = []; ?>
<?php $__blaze->pushData($__attrsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php ob_start(); ?>
        <?php echo e($tooltip); ?>

    <?php $__slotsa3135de46300f669a9a8e42bedbaf8ae['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php _a3135de46300f669a9a8e42bedbaf8ae($__blaze, $__attrsa3135de46300f669a9a8e42bedbaf8ae, $__slotsa3135de46300f669a9a8e42bedbaf8ae, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__slotsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__slotsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php if (! empty($__attrsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__attrsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__attrsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php $__blaze->popData(); ?>
<?php $__slots1677c28325f5b2e4c1307da836953e0c['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots1677c28325f5b2e4c1307da836953e0c); ?>
<?php _1677c28325f5b2e4c1307da836953e0c($__blaze, $__attrs1677c28325f5b2e4c1307da836953e0c, $__slots1677c28325f5b2e4c1307da836953e0c, ['position'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack1677c28325f5b2e4c1307da836953e0c)) { $__slots1677c28325f5b2e4c1307da836953e0c = array_pop($__slotsStack1677c28325f5b2e4c1307da836953e0c); } ?>
<?php if (! empty($__attrsStack1677c28325f5b2e4c1307da836953e0c)) { $__attrs1677c28325f5b2e4c1307da836953e0c = array_pop($__attrsStack1677c28325f5b2e4c1307da836953e0c); } ?>
<?php $__blaze->popData(); ?><?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php ENDPATH**/ ?>
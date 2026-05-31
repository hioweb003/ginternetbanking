<?php
if (!function_exists('__8b113406ca53f0c5ef3cb3b40af68667')):
function __8b113406ca53f0c5ef3cb3b40af68667($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'expandable' => false,
    'expanded' => true,
    'heading' => null,
    'icon' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$expandable ??= $attributes['expandable'] ?? $__defaults['expandable']; unset($attributes['expandable']);
$expanded ??= $attributes['expanded'] ?? $__defaults['expanded']; unset($attributes['expanded']);
$heading ??= $attributes['heading'] ?? $__defaults['heading']; unset($attributes['heading']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php if ($expandable && $heading): ?>
    <?php if ($icon): ?>
        <ui-disclosure <?php echo e($attributes->class('group/disclosure in-data-flux-sidebar-collapsed-desktop:hidden')); ?> <?php if($expanded === true): ?> open <?php endif; ?> data-flux-sidebar-group>
            <button type="button" class="border-1 border-transparent w-full h-8 in-data-flux-sidebar-on-mobile:h-10 flex items-center group/disclosure-button my-px rounded-lg hover:bg-zinc-800/5 dark:hover:bg-white/[7%] text-zinc-500 hover:text-zinc-800 dark:text-white/80 dark:hover:text-white">
                <div class="px-3">
                    <?php if (is_string($icon) && $icon !== ''): ?>
                        <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/1076136291a468841f5527c710e431e9.php'); ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => 'size-4']); ?>
<?php __1076136291a468841f5527c710e431e9($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => 'size-4'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php else: ?>
                        <?php echo e($icon); ?>

                    <?php endif; ?>
                </div>

                <span class="flex-1 text-left rtl:text-right text-sm font-medium leading-none"><?php echo e($heading); ?></span>

                <div class="ps-3 pe-2.5">
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-down.blade.php', $__blaze->compiledPath.'/6ed45f21b842ff427df4404d920a8fea.php'); ?>
<?php $__blaze->pushData(['class' => 'size-3! hidden group-data-open/disclosure-button:block']); ?>
<?php __6ed45f21b842ff427df4404d920a8fea($__blaze, ['class' => 'size-3! hidden group-data-open/disclosure-button:block'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-right.blade.php', $__blaze->compiledPath.'/9d3f7f9fb4749a2fea3b2f8689959d05.php'); ?>
<?php $__blaze->pushData(['class' => 'size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180']); ?>
<?php __9d3f7f9fb4749a2fea3b2f8689959d05($__blaze, ['class' => 'size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                </div>
            </button>

            <div class="relative hidden data-open:block ps-7" <?php if($expanded === true): ?> data-open <?php endif; ?>>
                <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-5"></div>

                <div class="flex flex-col">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </ui-disclosure>

        <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/dropdown.blade.php', $__blaze->compiledPath.'/e4966219ba3f0a981e1925f994475562.php'); ?>
<?php if (isset($__slotse4966219ba3f0a981e1925f994475562)) { $__slotsStacke4966219ba3f0a981e1925f994475562[] = $__slotse4966219ba3f0a981e1925f994475562; } ?>
<?php if (isset($__attrse4966219ba3f0a981e1925f994475562)) { $__attrsStacke4966219ba3f0a981e1925f994475562[] = $__attrse4966219ba3f0a981e1925f994475562; } ?>
<?php $__attrse4966219ba3f0a981e1925f994475562 = ['hover' => true,'class' => 'in-data-flux-sidebar-on-mobile:hidden not-in-data-flux-sidebar-collapsed-desktop:hidden','position' => 'right','align' => 'start','dataFluxSidebarGroupDropdown' => true]; ?>
<?php $__slotse4966219ba3f0a981e1925f994475562 = []; ?>
<?php $__blaze->pushData($__attrse4966219ba3f0a981e1925f994475562); ?>
<?php ob_start(); ?>
            <button type="button" class="border-1 border-transparent w-full px-3 in-data-flux-menu:px-2 h-8 flex gap-3 items-center group/disclosure-button my-px rounded-lg in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-menu:w-10 in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-menu:justify-center hover:bg-zinc-800/5 dark:hover:bg-white/[7%] in-data-flux-menu:hover:bg-zinc-50 dark:in-data-flux-menu:hover:bg-zinc-600 text-zinc-500 in-data-flux-menu:text-zinc-800 hover:text-zinc-800 dark:text-white/80 in-data-flux-menu:dark:text-white dark:hover:text-white">
                <?php if ($icon): ?>
                    <div class="relative">
                        <?php if (is_string($icon) && $icon !== ''): ?>
                            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/1076136291a468841f5527c710e431e9.php'); ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => 'in-data-flux-menu:text-zinc-400 in-data-flux-menu:dark:text-white/80 in-data-flux-menu:[[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current size-4']); ?>
<?php __1076136291a468841f5527c710e431e9($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => 'in-data-flux-menu:text-zinc-400 in-data-flux-menu:dark:text-white/80 in-data-flux-menu:[[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current size-4'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                        <?php else: ?>
                            <?php echo e($icon); ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <span class="hidden in-data-flux-menu:block flex-1 text-start text-sm font-medium leading-none text-zinc-800 dark:text-white"><?php echo e($heading); ?></span>

                <div class="hidden in-data-flux-menu:block">
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-right.blade.php', $__blaze->compiledPath.'/9d3f7f9fb4749a2fea3b2f8689959d05.php'); ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current rtl:hidden']); ?>
<?php __9d3f7f9fb4749a2fea3b2f8689959d05($__blaze, ['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current rtl:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-left.blade.php', $__blaze->compiledPath.'/a3efccd0ff033ce9daacdba7bf12310b.php'); ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current hidden rtl:inline']); ?>
<?php __a3efccd0ff033ce9daacdba7bf12310b($__blaze, ['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current hidden rtl:inline'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                </div>
            </button>

            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/index.blade.php', $__blaze->compiledPath.'/e585c956760029c855aaea589b9e9d95.php'); ?>
<?php if (isset($__slotse585c956760029c855aaea589b9e9d95)) { $__slotsStacke585c956760029c855aaea589b9e9d95[] = $__slotse585c956760029c855aaea589b9e9d95; } ?>
<?php if (isset($__attrse585c956760029c855aaea589b9e9d95)) { $__attrsStacke585c956760029c855aaea589b9e9d95[] = $__attrse585c956760029c855aaea589b9e9d95; } ?>
<?php $__attrse585c956760029c855aaea589b9e9d95 = []; ?>
<?php $__slotse585c956760029c855aaea589b9e9d95 = []; ?>
<?php $__blaze->pushData($__attrse585c956760029c855aaea589b9e9d95); ?>
<?php ob_start(); ?>
                <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/group.blade.php', $__blaze->compiledPath.'/24e57d10f0a548cd72c29484f8b61d80.php'); ?>
<?php if (isset($__slots24e57d10f0a548cd72c29484f8b61d80)) { $__slotsStack24e57d10f0a548cd72c29484f8b61d80[] = $__slots24e57d10f0a548cd72c29484f8b61d80; } ?>
<?php if (isset($__attrs24e57d10f0a548cd72c29484f8b61d80)) { $__attrsStack24e57d10f0a548cd72c29484f8b61d80[] = $__attrs24e57d10f0a548cd72c29484f8b61d80; } ?>
<?php $__attrs24e57d10f0a548cd72c29484f8b61d80 = ['heading' => $heading]; ?>
<?php $__slots24e57d10f0a548cd72c29484f8b61d80 = []; ?>
<?php $__blaze->pushData($__attrs24e57d10f0a548cd72c29484f8b61d80); ?>
<?php ob_start(); ?>
                    <?php echo e($slot); ?>

                <?php $__slots24e57d10f0a548cd72c29484f8b61d80['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots24e57d10f0a548cd72c29484f8b61d80); ?>
<?php __24e57d10f0a548cd72c29484f8b61d80($__blaze, $__attrs24e57d10f0a548cd72c29484f8b61d80, $__slots24e57d10f0a548cd72c29484f8b61d80, ['heading'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack24e57d10f0a548cd72c29484f8b61d80)) { $__slots24e57d10f0a548cd72c29484f8b61d80 = array_pop($__slotsStack24e57d10f0a548cd72c29484f8b61d80); } ?>
<?php if (! empty($__attrsStack24e57d10f0a548cd72c29484f8b61d80)) { $__attrs24e57d10f0a548cd72c29484f8b61d80 = array_pop($__attrsStack24e57d10f0a548cd72c29484f8b61d80); } ?>
<?php $__blaze->popData(); ?>
            <?php $__slotse585c956760029c855aaea589b9e9d95['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotse585c956760029c855aaea589b9e9d95); ?>
<?php __e585c956760029c855aaea589b9e9d95($__blaze, $__attrse585c956760029c855aaea589b9e9d95, $__slotse585c956760029c855aaea589b9e9d95, [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacke585c956760029c855aaea589b9e9d95)) { $__slotse585c956760029c855aaea589b9e9d95 = array_pop($__slotsStacke585c956760029c855aaea589b9e9d95); } ?>
<?php if (! empty($__attrsStacke585c956760029c855aaea589b9e9d95)) { $__attrse585c956760029c855aaea589b9e9d95 = array_pop($__attrsStacke585c956760029c855aaea589b9e9d95); } ?>
<?php $__blaze->popData(); ?>
        <?php $__slotse4966219ba3f0a981e1925f994475562['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotse4966219ba3f0a981e1925f994475562); ?>
<?php __e4966219ba3f0a981e1925f994475562($__blaze, $__attrse4966219ba3f0a981e1925f994475562, $__slotse4966219ba3f0a981e1925f994475562, ['hover', 'dataFluxSidebarGroupDropdown'], ['dataFluxSidebarGroupDropdown' => 'data-flux-sidebar-group-dropdown'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacke4966219ba3f0a981e1925f994475562)) { $__slotse4966219ba3f0a981e1925f994475562 = array_pop($__slotsStacke4966219ba3f0a981e1925f994475562); } ?>
<?php if (! empty($__attrsStacke4966219ba3f0a981e1925f994475562)) { $__attrse4966219ba3f0a981e1925f994475562 = array_pop($__attrsStacke4966219ba3f0a981e1925f994475562); } ?>
<?php $__blaze->popData(); ?>
    <?php else: ?>
        <ui-disclosure <?php echo e($attributes->class('group/disclosure in-data-flux-sidebar-collapsed-desktop:hidden')); ?> <?php if($expanded === true): ?> open <?php endif; ?> data-flux-sidebar-group>
            <button type="button" class="border-1 border-transparent w-full h-8 in-data-flux-sidebar-on-mobile:h-10 flex items-center group/disclosure-button my-px rounded-lg hover:bg-zinc-800/5 dark:hover:bg-white/[7%] text-zinc-500 hover:text-zinc-800 dark:text-white/80 dark:hover:text-white">
                <div class="ps-3.5 pe-3.5">
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-down.blade.php', $__blaze->compiledPath.'/6ed45f21b842ff427df4404d920a8fea.php'); ?>
<?php $__blaze->pushData(['class' => 'size-3! hidden group-data-open/disclosure-button:block']); ?>
<?php __6ed45f21b842ff427df4404d920a8fea($__blaze, ['class' => 'size-3! hidden group-data-open/disclosure-button:block'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/chevron-right.blade.php', $__blaze->compiledPath.'/9d3f7f9fb4749a2fea3b2f8689959d05.php'); ?>
<?php $__blaze->pushData(['class' => 'size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180']); ?>
<?php __9d3f7f9fb4749a2fea3b2f8689959d05($__blaze, ['class' => 'size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                </div>

                <span class="text-sm font-medium leading-none"><?php echo e($heading); ?></span>
            </button>

            <div class="relative hidden data-open:block ps-7" <?php if($expanded === true): ?> data-open <?php endif; ?>>
                <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-5"></div>

                <div class="flex flex-col">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </ui-disclosure>
    <?php endif; ?>

<?php elseif ($heading): ?>
    <div <?php echo e($attributes->class('flex flex-col in-data-flux-sidebar-collapsed-desktop:hidden')); ?> data-flux-sidebar-group>
        <div class="px-3 py-2">
            <div class="text-sm text-zinc-400 font-medium leading-none"><?php echo e($heading); ?></div>
        </div>

        <div class="flex flex-col">
            <?php echo e($slot); ?>

        </div>
    </div>
<?php else: ?>
    <div <?php echo e($attributes->class('flex flex-col in-data-flux-sidebar-collapsed-desktop:hidden')); ?> data-flux-sidebar-group>
        <?php echo e($slot); ?>

    </div>
<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/group.blade.php ENDPATH**/ ?>
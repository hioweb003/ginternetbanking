<?php # [BlazeFolded]:{flux::sidebar.collapse}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/collapse.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar.header}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/header.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar.group}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/group.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar.nav}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/nav.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar.spacer}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/spacer.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::icon.sun}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/sun.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::icon.moon}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/moon.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::button}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/button/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/dropdown.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar.nav}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/nav.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu.radio.group}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/radio/group.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/dropdown.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::sidebar}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::main}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/main.blade.php}:{1776985208} ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <title><?php echo e($title ?? ""); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo e(asset('img/1742153723_GrubiesCore.png')); ?>">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('flux')->fluxAppearance(); ?>

</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <?php ob_start(); ?><ui-sidebar-toggle class="z-20 fixed inset-0 bg-black/10 hidden data-flux-sidebar-on-mobile:not-data-flux-sidebar-collapsed-mobile:block" data-flux-sidebar-backdrop></ui-sidebar-toggle>

<ui-sidebar
    class="[grid-area:sidebar] z-1 flex flex-col gap-4 [:where(&amp;)]:w-64 p-4 data-flux-sidebar-collapsed-desktop:w-14 data-flux-sidebar-collapsed-desktop:px-2 data-flux-sidebar-collapsed-desktop:cursor-e-resize rtl:data-flux-sidebar-collapsed-desktop:cursor-w-resize max-lg:data-flux-sidebar-cloak:hidden data-flux-sidebar-on-mobile:data-flux-sidebar-collapsed-mobile:-translate-x-full data-flux-sidebar-on-mobile:data-flux-sidebar-collapsed-mobile:rtl:translate-x-full z-20! data-flux-sidebar-on-mobile:start-0! data-flux-sidebar-on-mobile:fixed! data-flux-sidebar-on-mobile:top-0! data-flux-sidebar-on-mobile:min-h-dvh! data-flux-sidebar-on-mobile:max-h-dvh! max-h-dvh overflow-y-auto overscroll-contain bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700" x-init="$el.classList.add(&#039;transition-transform&#039;)"
     collapsible="mobile"          sticky     x-data
    data-flux-sidebar-cloak
    data-flux-sidebar
>
    <?php ob_start(); ?>
        <?php ob_start(); ?><div class="flex items-center justify-between gap-2 min-h-10" data-flux-sidebar-header>
    <?php ob_start(); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/76911205cf062e2849c5941b8395af83.php'); ?>
<?php $__blaze->pushData(['href' => '#','logo' => e(asset('img/1742153723_GrubiesCore.png')),'logo:dark' => e(asset('img/1742153723_GrubiesCore.png')),'name' => 'Grubies']); ?>
<?php _76911205cf062e2849c5941b8395af83($__blaze, ['href' => '#','logo' => e(asset('img/1742153723_GrubiesCore.png')),'logo:dark' => e(asset('img/1742153723_GrubiesCore.png')),'name' => 'Grubies'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>

            <?php ob_start(); ?><ui-sidebar-toggle class="w-10 h-8 flex items-center justify-center in-data-flux-sidebar-collapsed-desktop:opacity-0 in-data-flux-sidebar-collapsed-desktop:absolute in-data-flux-sidebar-collapsed-desktop:in-data-flux-sidebar-active:opacity-100  lg:hidden" data-flux-sidebar-collapse>
    <ui-tooltip position="right center"  data-flux-tooltip >
        <button type="button" class="size-10 relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none text-sm rounded-lg inline-flex  bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white in-data-flux-sidebar-collapsed-desktop:cursor-e-resize rtl:in-data-flux-sidebar-collapsed-desktop:cursor-w-resize [&amp;[collapsible=&quot;mobile&quot;]]:in-data-flux-sidebar-on-desktop:hidden rtl:rotate-180">
            <svg class="text-zinc-500 dark:text-zinc-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.5 3.75V16.25M3.4375 16.25H16.5625C17.08 16.25 17.5 15.83 17.5 15.3125V4.6875C17.5 4.17 17.08 3.75 16.5625 3.75H3.4375C2.92 3.75 2.5 4.17 2.5 4.6875V15.3125C2.5 15.83 2.92 16.25 3.4375 16.25Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

                    <div popover="manual" class="relative py-2 px-2.5 rounded-md text-xs text-white font-medium bg-zinc-800 dark:bg-zinc-700 dark:border dark:border-white/10 p-0 overflow-visible" data-flux-tooltip-content>
    Toggle sidebar

    </div>
            </ui-tooltip>
</ui-sidebar-toggle>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</div><?php echo ltrim(ob_get_clean()); ?>

        

        <?php ob_start(); ?><nav class="flex flex-col overflow-visible min-h-auto" data-flux-sidebar-nav>
    <?php ob_start(); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/8a017fd6d6d9cec25d1ac50ebd17ed8f.php'); ?>
<?php if (isset($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php if (isset($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = ['icon' => 'home','href' => e(route('ad.dashboard')),'wire:navigate.hover' => true,'current' => true]; ?>
<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = []; ?>
<?php $__blaze->pushData($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php ob_start(); ?>Dashboard<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f, $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f, ['wire:navigate.hover', 'current'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php if (! empty($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php $__blaze->popData(); ?>

            <?php ob_start(); ?><ui-disclosure class="group/disclosure in-data-flux-sidebar-collapsed-desktop:hidden grid"  open  data-flux-sidebar-group>
            <button type="button" class="border-1 border-transparent w-full h-8 in-data-flux-sidebar-on-mobile:h-10 flex items-center group/disclosure-button my-px rounded-lg hover:bg-zinc-800/5 dark:hover:bg-white/[7%] text-zinc-500 hover:text-zinc-800 dark:text-white/80 dark:hover:text-white">
                <div class="ps-3.5 pe-3.5">
                    <svg class="shrink-0 [:where(&amp;)]:size-6 size-3! hidden group-data-open/disclosure-button:block" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
</svg>

                            <svg class="shrink-0 [:where(&amp;)]:size-6 size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
</svg>

                        </div>

                <span class="text-sm font-medium leading-none">Institutions</span>
            </button>

            <div class="relative hidden data-open:block ps-7"  data-open >
                <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-5"></div>

                <div class="flex flex-col">
                    <?php ob_start(); ?>
                <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/8a017fd6d6d9cec25d1ac50ebd17ed8f.php'); ?>
<?php if (isset($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php if (isset($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = ['href' => e(route('manage.intst')),'wire:navigate.hover' => true]; ?>
<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = []; ?>
<?php $__blaze->pushData($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php ob_start(); ?>Manage Institutions<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f, $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f, ['wire:navigate.hover'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php if (! empty($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php $__blaze->popData(); ?>
                <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/8a017fd6d6d9cec25d1ac50ebd17ed8f.php'); ?>
<?php if (isset($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php if (isset($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = ['href' => e(route('add.intst')),'wire:navigate.hover' => true]; ?>
<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = []; ?>
<?php $__blaze->pushData($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php ob_start(); ?>Add New Institution<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f, $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f, ['wire:navigate.hover'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php if (! empty($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php $__blaze->popData(); ?>
            <?php echo trim(ob_get_clean()); ?>

                </div>
            </div>
        </ui-disclosure>
    
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</nav>
<?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><div class="flex-1 pointer-events-none" data-flux-sidebar-spacer></div><?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><nav class="flex flex-col overflow-visible min-h-auto" data-flux-sidebar-nav>
    <?php ob_start(); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/8a017fd6d6d9cec25d1ac50ebd17ed8f.php'); ?>
<?php if (isset($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php if (isset($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = ['icon' => 'user','href' => e(route('manage.users')),'wire:navigate.hover' => true]; ?>
<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = []; ?>
<?php $__blaze->pushData($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php ob_start(); ?>Users<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f, $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f, ['wire:navigate.hover'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php if (! empty($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php $__blaze->popData(); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/8a017fd6d6d9cec25d1ac50ebd17ed8f.php'); ?>
<?php if (isset($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php if (isset($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f[] = $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f; } ?>
<?php $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = ['icon' => 'key','href' => e(route('changepass')),'wire:navigate.hover' => true]; ?>
<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = []; ?>
<?php $__blaze->pushData($__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php ob_start(); ?>Change Password<?php $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots8a017fd6d6d9cec25d1ac50ebd17ed8f); ?>
<?php _8a017fd6d6d9cec25d1ac50ebd17ed8f($__blaze, $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f, $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f, ['wire:navigate.hover'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__slots8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__slotsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php if (! empty($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f)) { $__attrs8a017fd6d6d9cec25d1ac50ebd17ed8f = array_pop($__attrsStack8a017fd6d6d9cec25d1ac50ebd17ed8f); } ?>
<?php $__blaze->popData(); ?>
 
            <?php ob_start(); ?><ui-dropdown position="bottom end" x-data="" data-flux-dropdown>
    <?php ob_start(); ?>
                <?php ob_start(); ?><button type="button" class="relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none justify-center h-10 text-sm rounded-lg w-10 inline-flex  bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white      group" data-flux-button="data-flux-button" aria-label="Preferred color scheme">
        <?php ob_start(); ?>
                    
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-5 text-zinc-500 dark:text-white" x-show="$flux.appearance === 'light'" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-5 text-zinc-500 dark:text-white" x-show="$flux.appearance === 'dark'" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z" clip-rule="evenodd"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                    
                <?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>

                <?php ob_start(); ?><ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden"
    popover="manual"
    data-flux-menu
>
    <?php ob_start(); ?>
                    <?php ob_start(); ?><button type="button" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" x-on:click="$flux.appearance = 'light'">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"/>
</svg>

            
    <?php ob_start(); ?>Light<?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>
                    <?php ob_start(); ?><button type="button" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" x-on:click="$flux.appearance = 'dark'">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z" clip-rule="evenodd"/>
</svg>

            
    <?php ob_start(); ?>Dark<?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>
                    
                <?php echo trim(ob_get_clean()); ?>

</ui-menu>
<?php echo ltrim(ob_get_clean()); ?>
            <?php echo trim(ob_get_clean()); ?>

</ui-dropdown>
<?php echo ltrim(ob_get_clean()); ?>

        <?php echo trim(ob_get_clean()); ?>

</nav>
<?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><ui-dropdown position="top start" class="max-lg:hidden" data-flux-dropdown>
    <?php ob_start(); ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/profile.blade.php', $__blaze->compiledPath.'/bc93d954499c235e1ce50765b75f3c74.php'); ?>
<?php $__blaze->pushData(['avatar' => e(asset('img/userface.jpg')),'name' => e(Auth::user()->name ?? 'admin')]); ?>
<?php _bc93d954499c235e1ce50765b75f3c74($__blaze, ['avatar' => e(asset('img/userface.jpg')),'name' => e(Auth::user()->name ?? 'admin')], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>

            
            <?php ob_start(); ?><ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden"
    popover="manual"
    data-flux-menu
>
    <?php ob_start(); ?>
                <?php ob_start(); ?><ui-menu-radio-group  data-flux-menu-radio-group>
    <?php ob_start(); ?>
                    
                    
                <?php echo trim(ob_get_clean()); ?>

</ui-menu-radio-group>
<?php echo ltrim(ob_get_clean()); ?>

                

                <?php ob_start(); ?><a href="<?php echo e(route('logout')); ?>" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
</svg>

            
    <?php ob_start(); ?>Logout<?php echo trim(ob_get_clean()); ?>

    </a>
<?php echo ltrim(ob_get_clean()); ?>
            <?php echo trim(ob_get_clean()); ?>

</ui-menu>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</ui-dropdown>
<?php echo ltrim(ob_get_clean()); ?>
    <?php echo trim(ob_get_clean()); ?>

</ui-sidebar>
<?php echo ltrim(ob_get_clean()); ?>


    <?php ob_start(); ?><div class="[grid-area:main] p-6 lg:p-8 [[data-flux-container]_&amp;]:px-0" data-flux-main>
    <?php ob_start(); ?>
       

         <?php echo e($slot); ?> 
<?php echo trim(ob_get_clean()); ?>

</div>
<?php echo ltrim(ob_get_clean()); ?>

    <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    <script src="<?php echo e(asset('js/sweetalert.js')); ?>" ></script>

    <script>
        window.addEventListener('notify',(event) => {
        const data = event.detail;
        // console.log(data[0].type);
        
            swal({
                    icon: data[0].type,
                    text: data[0].message,
                    position: data[0].position,
                    timer: data[0].timer,
                    buttons: data[0].button,
                });

            if(data[0].option == "modalclose"){
                $("#"+data[0].modalid).modal('hide');
            }
        });

        // document.addEventListener("DOMContentLoaded", () => {
        //     const themeToggle = document.getElementById("theme-toggle");
        //     const htmlElement = document.documentElement;

        //     // Load theme from localStorage
        //     const currentTheme = localStorage.getItem("theme") || "light";
        //     htmlElement.setAttribute("data-theme", currentTheme);

        //     // Update button text
        //     themeToggle.textContent = currentTheme === "dark" ? "Light Mode" : "Dark Mode";

        //     themeToggle.addEventListener("click", () => {
        //         const newTheme = htmlElement.getAttribute("data-theme") === "light" ? "dark" : "light";
        //         htmlElement.setAttribute("data-theme", newTheme);
        //         localStorage.setItem("theme", newTheme); // Save theme to localStorage
        //         themeToggle.textContent = newTheme === "dark" ? "Light Mode" : "Dark Mode";
        //     });
        // });
    </script>
    
</body>
</html><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/resources/views/layouts/admin.blade.php ENDPATH**/ ?>
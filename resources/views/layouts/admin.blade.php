<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{$title ?? ""}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/1742153723_GrubiesCore.png') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="#"
                logo="{{ asset('img/1742153723_GrubiesCore.png') }}"
                logo:dark="{{ asset('img/1742153723_GrubiesCore.png') }}"
                name="Grubies"
            />

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        {{-- <flux:sidebar.search placeholder="Search..." /> --}}

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="{{ route('ad.dashboard') }}" wire:navigate.hover current>Dashboard</flux:sidebar.item>

            <flux:sidebar.group expandable heading="Institutions" class="grid">
                <flux:sidebar.item href="{{ route('manage.intst') }}" wire:navigate.hover>Manage Institutions</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('add.intst') }}" wire:navigate.hover>Add New Institution</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="user" href="{{ route('manage.users') }}" wire:navigate.hover>Users</flux:sidebar.item>
            <flux:sidebar.item icon="key" href="{{ route('changepass') }}" wire:navigate.hover>Change Password</flux:sidebar.item>
 
            <flux:dropdown x-data align="end">
                <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                    
                    <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                    <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                    {{-- <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                    <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" /> --}}
                </flux:button>

                <flux:menu>
                    <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                    <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                    {{-- <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item> --}}
                </flux:menu>
            </flux:dropdown>

        </flux:sidebar.nav>

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile avatar="{{ asset('img/userface.jpg') }}" name="{{Auth::user()->name ?? 'admin'}}" />

            
            <flux:menu>
                <flux:menu.radio.group>
                    {{-- <flux:menu.radio checked>Olivia Martin</flux:menu.radio> --}}
                    {{-- <flux:menu.radio></flux:menu.radio> --}}
                </flux:menu.radio.group>

                {{-- <flux:menu.separator /> --}}

                <flux:menu.item href="{{ route('logout') }}" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>


    <flux:main >
       

         {{ $slot }} 
</flux:main>

    @fluxScripts
    <script src="{{asset('js/sweetalert.js')}}" ></script>

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
</html>
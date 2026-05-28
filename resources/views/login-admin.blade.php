<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/1742153723_GrubiesCore.png') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
       
        @livewireStyles
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">

    <div class="flex min-h-screen">
    <div class="flex-1 flex justify-center items-center">
        <div class="w-80 max-w-80 space-y-6">
            <div class="flex justify-center">
                <a href="{{ route('login') }}" wire:navigate.hover class="group flex items-center gap-3">
                    <div>
                        <img src="{{ asset('img/1742153723_GrubiesCore.png') }}" class="h-20 text-zinc-800 dark:text-white" alt="">
                    </div>

                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">Grubies Internet Banking</span>
                </a>
            </div>

          {{-- SELECT * FROM `transactions` WHERE `account_detail_id`=53 AND `paymentref`='Mxp20260313080036tyxvUFWlAt';  --}}

            <flux:separator />

             <livewire:auth.adminlogin />

            {{-- <flux:subheading class="text-center">
                First time around here? <flux:link href="#">Sign up for free</flux:link>
            </flux:subheading> --}}
        </div>
    </div>

    <div class="flex-1 p-4 max-lg:hidden">
        <div class="text-white relative rounded-lg h-full w-full bg-zinc-900 flex flex-col items-start justify-end p-16" style="background-image: url('/img/2151914227.jpg'); repeat:no-repeat; position:center; background-size: cover">
           
        </div>
    </div>
</div>

       @fluxScripts
</body>
</html>
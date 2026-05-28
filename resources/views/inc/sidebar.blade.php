@php
    $logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);
@endphp
<!-- Sidebar dark:hover:bg-gray-700 -->
<aside id="sidebar" class="fixed md:relative min-h-screen z-40 w-64 bg-white dark:bg-gray-800 shadow-xl flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300">

        <div class="p-6 text-2xl font-bold text-black dark:text-white flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="{{ $logo }}" class="w-6 h-6 object-contain" alt="">
                <span class="text-2xl text-normal">{{ucwords(app('tenant')->name)}}</span>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden text-gray-500 dark:text-white">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <nav class="flex-1 px-4 space-y-2 text-gray-700 dark:text-gray-200">
           
              <a href="{{ route('dashboard',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
                class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white  transition
                 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('dashboard'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif
                 ><i class="fa fa-home w-5"></i><span>Dashboard</span></a>

            <a href="{{ route('banktransfer',['institution' => app('tenant')->name]) }}" wire:navigate.hover
                class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                  {{ request()->routeIs('banktransfer') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('banktransfer'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif
           ><i class="fa fa-wallet w-5"></i><span>To Other Bank</span></a> 

            <a href="{{ route('wallettransfer',['institution' => app('tenant')->name]) }}" wire:navigate.hover
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
              {{ request()->routeIs('wallettransfer') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('wallettransfer'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif
             ><i class="fa fa-exchange-alt w-5"></i><span>Wallet Transfer</span></a>

            <a href="{{ route('airtime',['institution' => app('tenant')->name]) }}" wire:navigate.hover
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('airtime') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('airtime'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif            
                 ><i class="fa fa-signal w-5"></i><span>Airtime</span></a>

            <a href="{{ route('buydata',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('buydata') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('buydata'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif            
                 ><i class="fa fa-wifi w-5"></i><span>Buy Data</span></a>

            <a href="{{ route('cabletv',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('cabletv') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('cabletv'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif             
             ><i class="fa fa-television w-5"></i><span>Cable Tv</span></a>

            <a href="{{ route('electy',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('electy') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('electy'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif             
             ><i class="fa fa-lightbulb w-5"></i><span>Electricity</span></a>

             <a href="{{ route('trxshity',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('trxshity') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('trxshity'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif             
             ><i class="fa fa-file w-5"></i><span>Transaction History</span></a>

            <a href="{{ route('userprofile',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 rounded-xl text-black dark:text-white transition
                {{ request()->routeIs('userprofile') ? 'bg-gradient-to-r text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700 shadow-lg' }}"
                 @if(request()->routeIs('userprofile'))
                    style="background: linear-gradient(to right, {{ app('tenant')->color_one }}, {{ app('tenant')->color_two }});"
                @endif             
             ><i class="fa fa-user w-5"></i><span>Profile</span></a>

            <a href="{{ route('userlogout',['institution' => app('tenant')->name]) }}" class="menu-item flex items-center gap-4 p-3 rounded-xl text-red-500 hover:bg-red-100 dark:hover:bg-red-900 transition"><i class="fa fa-sign-out-alt w-5"></i><span>Logout</span></a>
        </nav>
    </aside>
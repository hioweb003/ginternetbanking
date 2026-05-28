<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Menu'])] class extends Component
{

    public ?string $token;


    public function mount(){

       $this->token = session('access_token');
       $expiresAt = session('access_token_expires_at');

        if (!$this->token || now()->greaterThan($expiresAt)) {
            auth()->logout();
            session()->flush();

            return $this->redirectRoute('home',['institution' => app('tenant')->name],navigate:true);
        }

    }
};
?>

<div>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

        <div class="flex-1 flex flex-col">

            <nav class="flex-1 px-4 space-y-2 text-gray-700 dark:text-gray-200">
           
              <a href="{{ route('dashboard',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
                class="menu-item flex items-center gap-4 p-3 text-black dark:text-white  transition border-b-1
                 {{ request()->routeIs('dashboard') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:bg-gray-700' }}"
                
                 ><i class="fa fa-home w-5"></i><span>Dashboard</span></a>

            <a href="{{ route('banktransfer',['institution' => app('tenant')->name]) }}" wire:navigate.hover
                class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                  {{ request()->routeIs('banktransfer') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             
           ><i class="fa fa-wallet w-5"></i><span>To Other Bank</span></a> 

            <a href="{{ route('wallettransfer',['institution' => app('tenant')->name]) }}" wire:navigate.hover
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
              {{ request()->routeIs('wallettransfer') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             ><i class="fa fa-exchange-alt w-5"></i><span>Wallet Transfer</span></a>

            <a href="{{ route('airtime',['institution' => app('tenant')->name]) }}" wire:navigate.hover
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('airtime') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
                 ><i class="fa fa-signal w-5"></i><span>Airtime</span></a>

            <a href="{{ route('buydata',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('buydata') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"          
                 ><i class="fa fa-wifi w-5"></i><span>Buy Data</span></a>

            <a href="{{ route('cabletv',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('cabletv') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             ><i class="fa fa-television w-5"></i><span>Cable Tv</span></a>

            <a href="{{ route('electy',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('electy') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             ><i class="fa fa-lightbulb w-5"></i><span>Electricity</span></a>

             <a href="{{ route('trxshity',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('trxshity') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             ><i class="fa fa-file w-5"></i><span>Transaction History</span></a>

            <a href="{{ route('userprofile',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
            class="menu-item flex items-center gap-4 p-3 text-black dark:text-white transition border-b-1
                {{ request()->routeIs('userprofile') ? 'text-white shadow-lg' : 'dark:hover:bg-gray-400 dark:hover:dark:hover:bg-gray-700' }}"
             ><i class="fa fa-user w-5"></i><span>Profile</span></a>

                <center class="mt-4">
                     <a href="{{ route('userlogout',['institution' => app('tenant')->name]) }}" class="text-red-500 hover:bg-red-100 dark:hover:bg-red-900 transition">
                        <i class="fa fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </a>
                </center>
        </nav>
            </div>  
       
    </div>    
</div>
<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Services'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

     public function mount(){

        $this->institution_name = app('tenant')->name;
        $this->institution_fullname = app('tenant')->fullname;
        $this->institution_code = app('tenant')->code;
        $this->institution_color = app('tenant')->color_one;
        $this->institution_colortwo = app('tenant')->color_two;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);

       $this->token = session('access_token');
       $expiresAt = session('access_token_expires_at');

        if (!$this->token || now()->greaterThan($expiresAt)) {
            auth()->logout();
            session()->flush();

            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

    }
};
?>

<div>
      <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
               <!-- Header -->
    <div class="flex items-center gap-3">
        <flux:button href="{{ route('dashboard', ['institution' => $institution_name]) }}" icon="arrow-left" variant="ghost" wire:navigate.hover />
        <flux:heading size="xl">Services</flux:heading>
    </div>
    
             <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">

            <!-- Item -->
             <a href="{{ route('banktransfer',['institution' => $institution_name]) }}" wire:navigate.hover>
                <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">

                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-wallet text-black dark:text-white text-lg"></i>
                </div>

                <span class="text-sm text-black dark:text-white whitespace-nowrap">To Other Bank</span>
            </div>
            </a>
            
            <a href="{{ route('wallettransfer',['institution' => $institution_name]) }}" wire:navigate.hover>
                <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">

                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-exchange text-black dark:text-white text-lg"></i>
                </div>

                <span class="text-sm text-black dark:text-white whitespace-nowrap">Wallet Transfer</span>
            </div>
            </a>

             <!-- Item -->
            <a href="{{ route('airtime',['institution' => $institution_name]) }}" wire:navigate.hover>
            <div  class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-signal text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Airtime</span>
            </div>
            </a>

             <!-- Item -->
         <a href="{{ route('buydata',['institution' => $institution_name]) }}" wire:navigate.hover >
                   <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-wifi text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Buy Data</span>
            </div>
        </a>

            <!-- Item -->
            <a href="{{ route('cabletv',['institution' => $institution_name]) }}" wire:navigate.hover>
            <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-television text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Cable TV</span>
            </div>
            </a>


            <!-- Item -->
            <a href="{{ route('electy',['institution' => $institution_name]) }}" wire:navigate.hover>
                 <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-lightbulb text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Electricity</span>
            </div>
            </a>

            {{-- <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-futbol text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300 whitespace-nowrap">Sports</span>
            </div>
             <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-piggy-bank text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300 whitespace-nowrap">Savings</span>
            </div>

            <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-hand-holding-usd text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300 whitespace-nowrap">Loan</span>
            </div> --}}

        </div>

        </main>
</div>
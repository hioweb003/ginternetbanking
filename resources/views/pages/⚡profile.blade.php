<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Profile'])] class extends Component
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
        {{-- <main class="p-2 md:p-4 space-y-6 flex-1">
        </main> --}}
 <main class="p-2 md:p-4 space-y-6 flex-1 pb-24 lg:pb-6">

    <!-- Header -->
    <div class="px-5 py-5">
        <flux:text class="text-center text-2xl font-bold text-gray-800 dark:text-white md:text-left">Profile</flux:text>
     
    </div>
    
        <a href="{{ route('user-profile-details',['institution' => $institution_name]) }}" wire:navigate.hover>
    <!-- Profile Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm flex items-center justify-between">


            <div class="flex items-center gap-4">

            <img src="{{ session('details')['profilepic'] ?? asset('img/userface.jpg') }}"
                 class="w-16 h-16 rounded-full object-cover"
                 alt="profile">

            <div>
                    <flux:text class="text-2xl text-gray-800 dark:text-white">{{!empty(session('details')["business_name"]) ? ucwords(session('details')["business_name"]) : 'Hi,'. ucwords(session('details')["first_name"])}}</flux:text>
         

                <div class="flex items-center gap-3 mt-2">

                    <span class="bg-slate-800 dark:bg-slate-200 dark:text-gray-500 text-white text-xs px-3 py-1 rounded-full">
                        {{ ucwords(session('details')['tier']) }}
                    </span>

                    <span class="text-gray-500 dark:text-white text-sm">
                        Account details
                    </span>

                </div>

            </div>

        </div>

       

        <button class="text-slate-400 dark:text-white text-3xl font-light">
            ›
        </button>

    </div>
 </a>
    <!-- Account & Settings -->
    <section>

        <flux:text class="text-sm font-bold text-gray-800 dark:text-white mb-4">Appearance & Security</flux:text>
 
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">

            <div class="flex items-center justify-between p-5 transition">

                <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-2xl bg-gray-100 flex items-center justify-center text-slate-500 text-sm">
                        <i class="fa fa-sun"></i>
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm">
                            Appearance
                        </h3>


                    </div>

                </div>

                  <div class="relative flex items-center w-20 bg-gray-200 dark:bg-gray-700 rounded-full p-1 text-xs font-semibold">

                    <!-- slider -->
                    <div id="toggleSlider"
                        class="absolute left-1 w-9 h-6 bg-gray-400 rounded-full shadow transition-all duration-300">
                    </div>

                    <button onclick="toggleDark('light')" class="relative z-10 w-1/2 py-1 text-center">
                        <i class="fa fa-sun"></i>
                    </button>

                    <button onclick="toggleDark('dark')" class="relative z-10 w-1/2 py-1 text-center">
                        <i class="fa fa-moon"></i>
                    </button>

                </div>

            </div>

           
                <a href="{{ route('change-password',['institution' => $institution_name]) }}" wire:navigate.hover>

            <div class="flex items-center justify-between p-5 transition">


                    <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-2xl bg-gray-100 flex items-center justify-center text-slate-500 text-sm">
                        <i class="fa fa-key"></i>
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm">
                            Change Password
                        </h3> 

                    </div>

                </div>

                
                    <span class="text-gray-400 dark:text-white text-2xl">›</span>
            </div>
            </a>

                <a href="{{ route('change-pin',['institution' => $institution_name]) }}" wire:navigate.hover>

            <div class="flex items-center justify-between p-5 transition">

                    <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-2xl bg-gray-100 flex items-center justify-center text-slate-500 text-sm">
                        <i class="fa fa-lock"></i>
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm">
                            Change Pin
                        </h3> 

                    </div>

                </div>

               
                    <span class="text-gray-400 dark:text-white text-2xl">›</span>
            </div>
             </a>
        </div>

    </section>

    <!-- Statement & Beneficiary -->
    <section>

        <flux:text class="text-sm font-bold text-gray-800 dark:text-white mb-4">
            Statement & Beneficiary
        </flux:text>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">

                <a href="{{ route('statement',['institution' => $institution_name]) }}" wire:navigate.hover>

            <div class="flex items-center justify-between p-5 border-b transition">


                    <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-2xl bg-gray-100 flex items-center justify-center text-slate-500 text-xl">
                        <i class="fa fa-file"></i>
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-800 dark:text-white text-lg">
                           Download Statement
                        </h3>

                        <p class="text-sm text-gray-400 dark:text-white">
                            Stay updated with your transactions.
                        </p>

                    </div>

                </div>

               

                <span class="text-gray-400 dark:text-white text-2xl">›</span>

            </div> 
        </a>

        <a href="{{ route('benfiy',['institution' => $institution_name]) }}" wire:navigate.hover>

            <div class="flex items-center justify-between p-5 transition">


                   <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-2xl bg-gray-100 flex items-center justify-center text-slate-500 text-xl">
                        <i class="fa fa-users"></i>
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-800 dark:text-white text-lg">
                            Beneficiary
                        </h3>

                        <p class="text-sm text-gray-400 dark:text-white">
                            Organize beneficiaries.
                        </p>

                    </div>

                </div>

               

                <span class="text-gray-400 dark:text-white text-2xl">›</span>

            </div>
        </a>

        </div>

    </section>

   
</main>
</div>
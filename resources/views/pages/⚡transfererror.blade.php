<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'error page'])] class extends Component
{
    public $token;
      public $institution_code;
    public $institution_color;
    public $institution_colortwo;
    public $institution_logo;
    public $institution_name;   
    public $institution_fullname;  
    
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
    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">

    <flux:card class="space-y-6 mx-auto w-full max-w-md lg:max-w-xl text-center">

        <!-- ICON -->
        <div class="flex justify-center">
            <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                <span class="text-3xl text-red-600 dark:text-red-400">
                    <flux:icon.x-mark />
                </span>
            </div>
        </div>

        <!-- TITLE -->
        <flux:heading size="lg" class="text-red-600 dark:text-red-400">
            Transaction Failed
        </flux:heading>

        <!-- MESSAGE -->
        <flux:text class="text-gray-600 dark:text-gray-300">
            We couldn't complete your transaction. Please try again or contact support.
        </flux:text>

        <!-- ERROR DETAILS -->
        <div class="bg-red-50 dark:bg-red-900/30 rounded-lg p-4 text-left">
            <p class="text-sm text-red-600 dark:text-red-400">
                Insufficient balance or network error.
            </p>
        </div>

        <!-- BUTTONS -->
        {{-- <div class="flex gap-3 pt-4">
            <flux:button href="/retry" variant="primary" class="w-full">
                Try Again
            </flux:button>

            <flux:button href="{{ route('dashboard',['institution' => app('tenant')->name]) }}" variant="ghost" class="w-full">
                Go Home
            </flux:button>
        </div> --}}

    </flux:card>

</div>
</div>
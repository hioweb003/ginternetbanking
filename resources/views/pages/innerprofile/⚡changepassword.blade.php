<?php

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Change Password'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

    public string $oldPassword;
    public string $newPassword;
    public string $confirmPassword;

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

     public function ChangePassword()
    {
        // Validate input
        $this->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ]);

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url'). 'customers/change-password', [
             "current_password" => $this->oldPassword,
            "new_password" => $this->newPassword,
            "userid" => session('details')["userid"] ?? '',
            "institution_code" => $this->institution_code
        ])->json();


         if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){

             $this->reset(['oldPassword', 'newPassword', 'confirmPassword']);

             $this->dispatch('notify', 
                    title: 'Success',
                    message: $response["message"] ?? "Password changed successfully.",
                    type: 'success'
                );

        }else{

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to change password.",
                    type: 'error'
                );
        }
       
    }
};
?>

<div>
      <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
               <!-- Header -->
    <div class="flex items-center gap-3">
        <flux:button href="{{ route('userprofile', ['institution' => $institution_name]) }}" icon="arrow-left" variant="ghost" wire:navigate.hover />
        <flux:heading size="xl">Change Password</flux:heading>
    </div>
    
                <flux:card class="space-y-6 mx-auto mt-8 w-full max-w-md lg:max-w-xl">

                    <div class="space-y-6">
                         <flux:input placeholder="Enter Old Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="oldPassword" viewable />
                         <flux:input placeholder="Enter New Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="newPassword" viewable />

                        <flux:input placeholder="Confirm New Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="confirmPassword" viewable />

                       {{-- <div x-data="{OldPassword: false}">
                        <flux:input placeholder="Enter Old Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="oldPassword">
                            <x-slot name="iconTrailing">
                                <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                            </x-slot>
                        </flux:input> 
                        </div>
                        
                        <flux:input placeholder="Enter New Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="newPassword">
                            <x-slot name="iconTrailing">
                                <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                            </x-slot>
                        </flux:input> 
                        
                        <flux:input placeholder="Confirm New Password" class="w-full my-2" type="password" autocomplete="off"  wire:model="confirmPassword">
                            <x-slot name="iconTrailing">
                                <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                            </x-slot>
                        </flux:input> --}}

                    <div class="space-y-3 mt-3">

                        <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="ChangePassword"  class="w-full cursor-pointer">Change Password</flux:button>

                    </div>
                 </div>
            </flux:card>

        </main>
</div>
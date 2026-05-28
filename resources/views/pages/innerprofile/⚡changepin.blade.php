<?php

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Change PIN'])] class extends Component
{

 public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

    public string $oldPin;
    public string $newPin;
    public string $confirmPin;


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

     public function ChangePin()
    {
        // Validate input
        $this->validate([
            'oldPin' => 'required',
            'newPin' => 'required|min:4',
            'confirmPin' => 'required|same:newPin',
        ]);

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url'). 'customers/change-pin', [
             "current_pin" => $this->oldPin,
            "new_pin" => $this->newPin,
            "userid" => session('details')["userid"] ?? '',
            "institution_code" => $this->institution_code
        ])->json();


         if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){
             $this->reset(['oldPin', 'newPin', 'confirmPin']);

             $this->dispatch('notify', 
                    title: 'Success',
                    message: $response["message"] ?? "Pin changed successfully.",
                    type: 'success'
                );
        }else{
             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to change pin.",
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
        <flux:heading size="xl">Change PIN</flux:heading>
    </div>
    
                <flux:card class="space-y-6 mx-auto mt-8 w-full max-w-md lg:max-w-xl">

                    <div class="space-y-6">
                         <flux:input placeholder="Enter Old PIN" class="w-full my-2" type="password" autocomplete="off"  wire:model="oldPin" viewable />
                         <flux:input placeholder="Enter New PIN" class="w-full my-2" type="password" autocomplete="off"  wire:model="newPin" viewable />

                        <flux:input placeholder="Confirm New PIN" class="w-full my-2" type="password" autocomplete="off"  wire:model="confirmPin" viewable />


                    <div class="space-y-3 mt-3">

                        <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="ChangePin"  class="w-full cursor-pointer">Change PIN</flux:button>

                    </div>
                 </div>
            </flux:card>

        </main>
</div>
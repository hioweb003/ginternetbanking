<?php

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Update Profile'])] class extends Component
{

   public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

    public string $phone_number;
    public string $email;
    public string $dob;
    public string $gender;
    public string $address;
    public string $bvn;
    public string $nin;

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

       $this->phone_number = session('details')['phone'] ?? '';
        $this->email = session('details')['email'] ?? '';
        $this->dob = session('details')['dob'] ?? '';
        $this->gender = session('details')['gender'] ?? '';
        $this->address = session('details')['address'] ?? '';
        $this->nin = session('details')['nin'] ?? '';
        $this->bvn = session('details')['bvn'] ?? '';
    }

     public function UpdateUserProfile()
    {

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url'). 'customers/update-profile', [
             "phone_number" => $this->phone_number,
            "email" => $this->email,
            "dob" => $this->dob,
            "gender" => $this->gender,
            "address" => $this->address,
            "bvn" => $this->bvn,
            "nin" => $this->nin,
            "institution_code" => $this->institution_code
        ])->json();


         if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){


             $this->dispatch('notify', 
                    title: 'Success',
                    message: $response["message"] ?? "Profile updated successfully.",
                    type: 'success'
                );

        }else{

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to update profile.",
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
                         <flux:input placeholder="Enter Phone Number" class="w-full my-2" type="text" autocomplete="off"  wire:model="phone_number" />
                         <flux:input placeholder="Enter Email" class="w-full my-2" type="email" autocomplete="off"  wire:model="email" />

                        <flux:input placeholder="Enter Date of Birth" class="w-full my-2" type="date" autocomplete="off"  wire:model="dob" />

                        <flux:select size="sm" wire:model="gender" placeholder="Select Gender...">  
                            <flux:select.option value="">Select</flux:select.option>
                                <flux:select.option value="male">Male</flux:select.option>
                                <flux:select.option value="female">Female</flux:select.option>
                        </flux:select>

                        <flux:input placeholder="Enter Address" class="w-full my-2" type="date" autocomplete="off"  wire:model="address" />
                        <flux:input placeholder="Enter BVN" class="w-full my-2" type="date" autocomplete="off"  wire:model="bvn" />
                        <flux:input placeholder="Enter NIN" class="w-full my-2" type="date" autocomplete="off"  wire:model="nin" />

                       
                    <div class="space-y-3 mt-3">

                        <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="UpdateUserProfile"  class="w-full cursor-pointer">Update</flux:button>

                    </div>
                 </div>
            </flux:card>

        </main>
</div>
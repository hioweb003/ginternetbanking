<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

new #[Layout('layouts::admin',['title' => 'Change Password'])] class extends Component
{

       #[Validate('required|min:8|confirmed')]
        public $password;

        public $password_confirmation;

        public $uid;

        public function mount(){
            $this->uid = Auth::user()->id;
        }

    public function UpdatePassword(){

            $this->validate();

            $intst =  User::where('id',$this->uid)->first();


            $intst->password = Hash::make($this->password);
            $intst->save();

            $this->reset();

              $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Passwor Changed',
                'position' => 'center',
            ]);
    }
};
?>

<div>
    <div class="w-70">
           <form wire:submit.prevent='UpdatePassword'>
        <flux:fieldset>
            <flux:legend>Change Password</flux:legend>
                    <flux:separator variant="subtle" class="mb-10" />


            <div class="space-y-6">
            <flux:input label="Password" type="password"  wire:model="password" />
            <flux:input label="Comfirm Password" type="password" wire:model="password_confirmation" />

                
            <flux:button type="submit" variant="primary" :loading="true">Change Password</flux:button>    

            </div>
        </flux:fieldset>
    </form>
    </div>
</div>
<?php

use Livewire\Component;
use Livewire\Attributes\Validate;


new class extends Component
{
    #[Validate('required|string')]
    public $username='';

     #[Validate('required|string|min:8')]
    public $password='';

    public function submitForm(){
            $this->validate();

            if(Auth::attempt(['username' => $this->username, 'password' => $this->password])){
               return redirect()->route("ad.dashboard");
            }else{
              session()->flash('error',"Invalid username or password");
            }
    }
};
?>

<div>
        <form  method="post">
    <div class="flex flex-col gap-6">
           @if (session()->has('error'))
                    <div class="text-red-600">
                        {{ session('error') }}
                    </div>
                @endif
                     <flux:input label="Username" wire:model='username' type="text" placeholder="username" />
                   
                {{--<flux:field>
                    <div class="mb-3 flex justify-between">
                        <flux:label>Password</flux:label>

                         <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link> 
                    </div>--}}

                    <flux:input label="Password" wire:model='password' type="password" placeholder="Your password" />
                  
                {{-- </flux:field> --}}

                {{-- <flux:checkbox label="Remember me for 30 days" /> --}}

                <flux:button  variant="primary" wire:click='submitForm' class="w-full" :loading="true">Log in</flux:button>    
           
    </div>
     </form> 
</div>
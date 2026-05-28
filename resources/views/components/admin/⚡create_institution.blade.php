<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Institution;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin',['title' => 'Create Institution'])] class extends Component
{
     use WithFileUploads;

    #[Validate('required|string')]
    public $name;
    
    #[Validate('required|string')]
    public $fullname;

     #[Validate('required|numeric')]
    public $code; 
    
    #[Validate('required|string')]
    public $primary_color;

    public $secondary_color;

    #[Validate('image|max:1024|mimes:png')] // 10MB Max
    public $logo;

    public function CreateInstitu(){

        $this->validate();

            $newlogofile = time()."_".$this->logo->getClientOriginalName();
            $imagePath = $this->logo->storeAs('uploads',$newlogofile,'public');
     
            
        Institution::create([
             'code' => $this->code,
             'name' => $this->name,
            'fullname' => $this->fullname,
             'color_one' => $this->primary_color,
             'color_two' => $this->secondary_color ?? "#ffffff",
             'logo' => $imagePath,
             'status' => 1
        ]);

        session()->flash('success',"Record Created");

         $this->reset();

         return $this->redirectRoute('manage.intst');
    }
};
?>

<div>
   <div class="flex flex-col gap-6">
           @if (session()->has('error'))
                    <div class="bg-red-400 text-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                 @if (session()->has('success'))
                    <div class="bg-green-400 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
   </div>
    <form wire:submit.prevent="CreateInstitu">
        <flux:fieldset>
            <flux:legend>Create Institution</flux:legend>

            <div class="space-y-6">
                <flux:input type="text" label="Institution Full Name" wire:model='fullname' placeholder="Institution Full Name" class="max-w-sm" />

                <flux:input type="text" label="Institution Short Name" wire:model.live='name' placeholder="Institution Short Name" class="max-w-sm" />
                <flux:text class="text-black">{{$name != "" ? "URL: ".strtolower($name).'.'.env("APP_DOMAIN") : ''}}</flux:text>
                <flux:input type="text" label="Institution Code" wire:model='code' placeholder="Institution Code" class="max-w-sm" />
                <flux:input type="color" label="Institution primary Color" wire:model='primary_color' placeholder="Institution primary Color" class="max-w-sm" />
                <flux:input type="color" label="Institution Secondary Color (Optional)" wire:model='secondary_color' placeholder="Institution Secondary Color (Optional)" class="max-w-sm" />
                <flux:input type="file" label="Upload logo" accept='.png'  wire:model='logo' class="max-w-sm" />

            <flux:button type="submit" variant="primary" :loading="true">Create Record</flux:button>    

            </div>
        </flux:fieldset>
    </form>
</div>
<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use \App\Models\Institution;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin',['title' => 'Edit Institution'])] class extends Component
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

    #[Validate('required|string')]
    public $secondary_color;

    public $mlogo;
    
    public $logo;

    public $uid;

    public function mount($id){

        $eddit = Institution::where('id',$id)->first();

           $this->code = $eddit->code;
            $this->name = $eddit->name;
            $this->fullname = $eddit->fullname;
            $this->primary_color = $eddit->color_one;
            $this->secondary_color = $eddit->color_two;
            $this->mlogo = $eddit->logo;
            $this->uid = $id;
    }

    public function EditInstitution(){

  $ddit = Institution::where('id',$this->uid)->first();

       
             $ddit->code = $this->code;
             $ddit->name = $this->name;
             $ddit->fullname = $this->fullname;
             $ddit->color_one = $this->primary_color;
             $ddit->color_two = $this->secondary_color ?? "#ffffff";
             $ddit->save();

    if(!is_null($this->logo)){

            if(file_exists($ddit->logo)){
                unlink($ddit->logo);
            }
            
            $newlogofile = time()."_".$this->logo->getClientOriginalName();
            $imagePath = $this->logo->storeAs('uploads',$newlogofile,'public');

            Institution::where('id',$this->uid)->update([
               "logo" => $imagePath
            ]);
        }

        session()->flash('success',"Record Updated");

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
    <form wire:submit.prevent='EditInstitution'>
        <flux:fieldset>
            <flux:legend>Edit Institution</flux:legend>

            <div class="space-y-6">
                <flux:input type="text" label="Institution Full Name" wire:model='fullname' placeholder="Institution Full Name" class="max-w-sm" />

                <flux:input type="text" label="Institution Short Name" wire:model='name' placeholder="Institution Short Name" class="max-w-sm" />
                <flux:text>{{!empty($this->name) ? $this->name.'.'.env("APP_DOMAIN") : ''}}</flux:text>
                <flux:input type="text" label="Institution Code" wire:model='code' placeholder="Institution Code" class="max-w-sm" />
                <flux:input type="color" label="Institution primary Color" wire:model='primary_color' placeholder="Institution primary Color" class="max-w-sm" />
                <flux:input type="color" label="Institution Secondary Color (Optional)" wire:model='secondary_color' placeholder="Institution Secondary Color (Optional)" class="max-w-sm" />
                
                <img src="{{env('APP_ENV') == "production" ? url(env('STORAGE_PATH').$mlogo) : asset('storage/'.$mlogo)}}" alt="Current Logo" class="w-32 h-32 object-contain" />

                <flux:input type="file" label="Upload logo"  wire:model='logo' class="max-w-sm" />

                
            <flux:button type="submit" variant="primary" class="mx-2" :loading="true">Update Record</flux:button>    
            <flux:button href="{{ route('manage.intst') }}"  wire:navigate.hover variant="outline">Cancel</flux:button>    
             </div>

            </div>
        </flux:fieldset>
    </form>

</div>
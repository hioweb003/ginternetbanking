<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

new #[Layout('layouts::admin',['title' => 'Manage Users'])] class extends Component
{
    
 public $showConfirmModal = false;

        public $saveType = "create";
        
        #[Validate('required|numeric')]
        public $level;
        
        #[Validate('required|string')]
        public $name;

        #[Validate('required|string')]
        public $username;

        public $password; 

        public $uid;

        public function mount(){
            $this->password = Str::random(10);
        }

     #[Computed]
      public function GetUsers(){
         return User::latest()->get();
     }

    public function EnableUser($uid){
        $intst =  User::where('id',$uid)->first();
         
        $stst = $intst->status == '1' ? '0' : '1';

        $intst->status = $stst;
        $intst->save();

         $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Status Changed',
                'position' => 'center',
            ]);

    }
    
    public function EditUser($uid){

        $intst =  User::where('id',$uid)->first();

        $this->showConfirmModal = true;

        $this->saveType = "update";
        $this->name =  $intst->name;
        $this->username = $intst->username;
        $this->level = $intst->level;
        $this->uid = $uid;
    }



    public function CreateUpdateUser(){

    $this->validate();

       if($this->saveType == "create"){
            User::create([
                'name' =>  $this->name,
                'username' =>  $this->username,
                'password' => Hash::make($this->password),
                'level' => $this->level
            ]);


         $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'User Created',
                'position' => 'center',

            ]);

            $this->reset();

       }else{
             User::where('id',$this->uid)->update([
                'name' =>  $this->name,
                'username' =>  $this->username,
                'level' => $this->level
            ]);

              $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'User updated',
                'position' => 'center',
            ]);

            $this->reset();
       }
    }

    public function openCreateUser()
    {
        $this->reset(['name','username','level','saveType']);

        $this->password = Str::random(10);
        $this->saveType = 'create';
    }
};
?>

<div>
   <flux:heading size="xl" level="1">Manage Users</flux:heading>

        {{-- <flux:text class="mb-6 mt-2 text-base">Institution</flux:text> --}}

      

        <flux:separator variant="subtle" class="mb-10" />

      <flux:modal.trigger name="create-profile" class="flex justify-end">
            <flux:button class="cursor-pointer" wire:click="openCreateUser">Create User</flux:button>
        </flux:modal.trigger>
        
        <flux:table>
            <flux:table.columns>
                <flux:table.column class="max-md:hidden">Name</flux:table.column>
                <flux:table.column class="max-md:hidden">Username</flux:table.column>
                <flux:table.column class="max-md:hidden">Status</flux:table.column>
                <flux:table.column class="max-md:hidden">Date</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->GetUsers as $row)
                    <flux:table.row>
                        <flux:table.cell class="max-md:hidden">{{ucwords($row->name)}}</flux:table.cell>
                        <flux:table.cell class="min-w-6">
                            {{ $row->username }}
                        </flux:table.cell>

                       <flux:table.cell class="max-md:hidden">
                             <flux:text class="{{$row->status == 1 ?  'text-green-500' : 'text-red-500'}}">{{$row->status == 1 ?  'Active' : 'Inactive'}}</flux:text>
                          </flux:table.cell>

                        <flux:table.cell class="max-md:hidden">{{ date('d-m-Y H:ia',strtotime($row->created_at)) }}</flux:table.cell>

                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end" offset="-15">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>

                                <flux:menu>
                                    <flux:tooltip content="View">
                                    <flux:menu.item icon="pencil-square" wire:click="EditUser('{{ $row->id }}')" wire:navigate.hover>Edit</flux:menu.item>
                                    </flux:tooltip>
                                    <flux:tooltip content="Enable/Disable">
                                       @if (Auth::user()->level == 1)
                                            <flux:menu.item icon="{{$row->status == 1 ?  'x-mark' : 'check'}}"  wire:click="EnableUser('{{ $row->id }}')"  color='{{$row->status == 1 ?  'red' : 'green'}}'>{{$row->status == 1 ?  'Deactivate' : 'Activate'}}</flux:menu.item>
                                       @endif
                                  </flux:tooltip>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
       
        <flux:modal name="create-profile" class="md:w-96"  wire:model.self="showConfirmModal">
<div class="space-y-6">

    <div>
        <flux:heading size="lg">{{ ucwords($saveType) }} profile</flux:heading>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-400 text-green-600">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="CreateUpdateUser">

        <flux:input label="Name" placeholder="Your name" wire:model="name" />

        <flux:input label="Username" placeholder="Your username" wire:model="username" />

        @if ($saveType == "create")
            <flux:input label="Password" type="text" readonly wire:model="password" />
        @endif

        <flux:select label="Level" wire:model="level" placeholder="Choose level...">
            <flux:select.option value="1">Level 1</flux:select.option>
            <flux:select.option value="2">Level 2</flux:select.option>
        </flux:select>

        <flux:input type="hidden" wire:model="saveType" />

        <div class="flex mt-10">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>

    </form>

</div>
</flux:modal>
</div>

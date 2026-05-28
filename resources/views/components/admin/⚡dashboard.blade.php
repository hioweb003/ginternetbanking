<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use \Livewire\WithPagination;
use \App\Models\Institution;
use Livewire\Attributes\Computed;

new #[Layout('layouts::admin',['title' => 'Dashboard'])] class extends Component
{
     public $rows=[];

     #[Computed]
     public function GetInstitution(){
         return Institution::latest()->take(15)->get();
     }

      public function EnableInstitution($uid){
        
        $intst =  Institution::where('id',$uid)->first();
         
        $stst = $intst->status == '1' ? '0' : '1';

        $intst->status = $stst;
        $intst->save();

         $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Status Changed',
                'position' => 'center',
            ]);

    }
};
?>

<div>
     <flux:heading size="xl" level="1">Dashboard</flux:heading>

        {{-- <flux:text class="mb-6 mt-2 text-base">Institution</flux:text> --}}

        <flux:separator variant="subtle" class="mb-20" />

        <flux:table>
            <flux:table.columns>
                <flux:table.column class="max-md:hidden">ID</flux:table.column>
                <flux:table.column class="max-md:hidden">Date</flux:table.column>
                <flux:table.column class="max-md:hidden">Institution Name</flux:table.column>
                <flux:table.column class="max-md:hidden">Logo</flux:table.column>
                <flux:table.column class="max-md:hidden">Status</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->GetInstitution as $row)
                    <flux:table.row>
                        <flux:table.cell class="max-md:hidden">#{{ $row->code }}</flux:table.cell>
                        <flux:table.cell class="max-md:hidden">{{ date('d-m-Y H:ia',strtotime($row->created_at)) }}</flux:table.cell>
                        <flux:table.cell class="max-md:hidden">{{ucwords($row->name)}} </flux:table.cell>
                        <flux:table.cell class="min-w-6">
                            <div class="flex items-center gap-2">
                                <img src="{{env('APP_ENV') == "production" ? url(env('STORAGE_PATH').$row->logo) : asset('storage/'.$row->logo)}}" width="60" height="60" size="xs" />
                            </div>
                        </flux:table.cell>
                          <flux:table.cell class="max-md:hidden">
                             <flux:text class="{{$row->status == 1 ?  'text-green-500' : 'text-red-500'}}">{{$row->status == 1 ?  'Active' : 'Inctive'}}</flux:text>
                          </flux:table.cell>

                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end" offset="-15">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>

                                <flux:menu>
                                    <flux:tooltip content="View">
                                    <flux:menu.item icon="pencil-square" href="{{ route('edit.intst',['id' => $row->id]) }}" wire:navigate.hover>Edit</flux:menu.item>
                                    </flux:tooltip>
                                    <flux:tooltip content="Enable/Disable">
                                       <flux:menu.item icon="{{$row->status == 1 ?  'x-mark' : 'check'}}"  wire:click="EnableInstitution('{{ $row->id }}')"  color='{{$row->status == 1 ?  'red' : 'green'}}'>{{$row->status == 1 ?  'Deactivate' : 'Activate'}}</flux:menu.item>
                                  </flux:tooltip>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>


</div>
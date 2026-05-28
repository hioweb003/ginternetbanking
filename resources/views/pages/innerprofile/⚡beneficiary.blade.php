<?php

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Beneficiary'])] class extends Component
{

    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

    public string $activeTab = 'bank';

    public $banks=[];
    public $wallets=[];
    public $phones=[];
    public $electricitys=[];
    public $cables=[];
    public $datas=[];
    public $bettings=[];
    
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

       $this->FetchBeneficiary();
    }

      #[Computed(persist: true, seconds: 1800)]
    public function FetchBeneficiary(){

        $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->get(config('services.api.base_url').'customers/get-beneficiary');


        if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response['status'] == true){
                  $this->banks = $response['bankdata'] ?? [];
                  $this->wallets = $response['walletdata'] ?? [];
                  $this->phones = $response['sms'] ?? [];
                  $this->electricitys = $response['bills'] ?? [];
                  $this->cables = $response['cable'] ?? [];
                  $this->datas = $response['data'] ?? [];
                  $this->bettings = $response['betting'] ?? [];
        }else{
           
            $this->dispatch('notify', 
                    title: 'Error',
                    message: 'Failed to fetch beneficiary banks. Please try again later.',
                    type: 'error'
                );
        }
    }

    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function deleteBeneficiary($uid){

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->get(config('services.api.base_url').'customers/delete-beneficiary',[
            'id' => $uid
        ]);

    if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response['status'] == true){
               $this->dispatch('notify', 
                    title: 'Success',
                    message: 'Beneficary Deleted',
                    type: 'success'
                );
        }else{
             $this->dispatch('notify', 
                    title: 'Error',
                    message: 'Failed to delete beneficiary',
                    type: 'error'
                );
        }
    }
   
};
?>

<div>
      <!-- Content -->
        {{-- <main class="p-2 md:p-4 space-y-6 flex-1">
        </main> --}}

    <main class="p-3 md:p-6 space-y-6 flex-1">

    <!-- Header -->
    <div class="flex items-center gap-3">
        <flux:button href="{{ route('userprofile', ['institution' => $institution_name]) }}"
            icon="arrow-left"
            variant="ghost"
            wire:navigate.hover
        />

        <flux:heading size="xl">
            Saved Beneficiaries
        </flux:heading>
    </div>

    <!-- Tabs -->
    <div class="overflow-x-auto">
        <div class="flex gap-3 min-w-max">

            <flux:button
                variant="{{ $activeTab == 'bank' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','bank')"
            >
                Banks
            </flux:button>

            <flux:button
                variant="{{ $activeTab == 'wallet' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','wallet')"
            >
                Wallet
            </flux:button>

            <flux:button
                variant="{{ $activeTab == 'phone' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','phone')"
            >
                Phone
            </flux:button>  
            
            <flux:button
                variant="{{ $activeTab == 'cable' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','cable')"
            >
                Cables
            </flux:button>

            <flux:button
                variant="{{ $activeTab == 'electricity' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','electricity')"
            >
                Electricity
            </flux:button>

             {{-- <flux:button
                variant="{{ $activeTab == 'betting' ? 'primary' : 'filled' }}"
                wire:click="$set('activeTab','betting')"
            >
                Betting
            </flux:button> --}}

        </div>
    </div>

    <!-- Search -->
    <flux:input
        icon="magnifying-glass"
        wire:model.live.debounce.500ms="search"
        placeholder="Search beneficiary..."
    />

    <!-- Beneficiaries -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">

        @if($activeTab === 'bank')

        @forelse($banks as $item)

            <flux:card
                wire:key="beneficiary-{{ $item['id'] }}"
                class="hover:shadow-md transition-all"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-semibold uppercase text-base">
                            {{ ucwords($item['account_name']) }}
                        </h3>

                        <p class="text-sm text-zinc-500 mt-1">
                            {{ $item['account_number'] }}
                            <span class="mx-2">|</span>
                            {{ ucwords($item['bank_name']) }}
                        </p>

                    </div>

                    <div class="flex items-center gap-2">

                        <flux:button size="sm"
                            variant="ghost"
                            color="red"
                            wire:click="deleteBeneficiary({{ $item['id'] }})"
                            wire:confirm="Delete this beneficiary?"
                        >
                            <i class="fa fa-trash text-red-500"></i>
                        </flux:button>

                    </div>

                </div>

            </flux:card>

        @empty

            <flux:card>

                <div class="text-center py-10">

                    <div class="text-zinc-400 mb-2">
                        <i class="fa fa-users text-4xl"></i>
                    </div>

                    <p class="text-zinc-500">
                        No beneficiaries found.
                    </p>

                </div>

            </flux:card>

        @endforelse

    @elseif($activeTab === "wallet")

     @forelse($wallets as $item)

            <flux:card
                wire:key="beneficiary-{{ $item['id'] }}"
                class="hover:shadow-md transition-all"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-semibold uppercase text-base">
                            {{ ucwords($item['account_name']) }}
                        </h3>

                        <p class="text-sm text-zinc-500 mt-1">
                            {{ $item['account_number'] }}
                            <span class="mx-2">|</span>
                            {{ ucwords($institution_fullname) }}
                        </p>

                    </div>

                    <div class="flex items-center gap-2">

                        <flux:button size="sm"
                            variant="ghost"
                            color="red"
                            wire:click="deleteBeneficiary({{ $item['id'] }})"
                            wire:confirm="Delete this beneficiary?"
                        >
                            <i class="fa fa-trash text-red-500"></i>
                        </flux:button>

                    </div>

                </div>

            </flux:card>

        @empty

            <flux:card>

                <div class="text-center py-10">

                    <div class="text-zinc-400 mb-2">
                        <i class="fa fa-users text-4xl"></i>
                    </div>

                    <p class="text-zinc-500">
                        No beneficiaries found.
                    </p>

                </div>

            </flux:card>

        @endforelse

    @elseif($activeTab === "phone")

     @forelse($phones as $item)

            <flux:card
                wire:key="beneficiary-{{ $item['id'] }}"
                class="hover:shadow-md transition-all"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-semibold uppercase text-base">
                            {{ $item['biller_number'] }}
                        </h3>

                        <p class="text-sm text-zinc-500 mt-1">
                            {{ ucwords($item['biller_name']) }}
                        </p>

                    </div>

                    <div class="flex items-center gap-2">

                        <flux:button size="sm"
                            variant="ghost"
                            color="red"
                            wire:click="deleteBeneficiary({{ $item['id'] }})"
                            wire:confirm="Delete this beneficiary?"
                        >
                            <i class="fa fa-trash text-red-500"></i>
                        </flux:button>

                    </div>

                </div>

            </flux:card>

        @empty

            <flux:card>

                <div class="text-center py-10">

                    <div class="text-zinc-400 mb-2">
                        <i class="fa fa-users text-4xl"></i>
                    </div>

                    <p class="text-zinc-500">
                        No beneficiaries found.
                    </p>

                </div>

            </flux:card>

        @endforelse

    @elseif($activeTab === "cable")

     @forelse($cables as $item)

            <flux:card
                wire:key="beneficiary-{{ $item['id'] }}"
                class="hover:shadow-md transition-all"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-semibold uppercase text-base">
                            {{ $item['biller_number'] }}
                        </h3>

                        <p class="text-sm text-zinc-500 mt-1">
                            {{ ucwords($item['biller_name']) }}
                        </p>

                    </div>

                    <div class="flex items-center gap-2">

                        <flux:button size="sm"
                            variant="ghost"
                            color="red"
                            wire:click="deleteBeneficiary({{ $item['id'] }})"
                            wire:confirm="Delete this beneficiary?"
                        >
                            <i class="fa fa-trash text-red-500"></i>
                        </flux:button>

                    </div>

                </div>

            </flux:card>

        @empty

            <flux:card>

                <div class="text-center py-10">

                    <div class="text-zinc-400 mb-2">
                        <i class="fa fa-users text-4xl"></i>
                    </div>

                    <p class="text-zinc-500">
                        No beneficiaries found.
                    </p>

                </div>

            </flux:card>

        @endforelse

    @elseif($activeTab === "electricity")

     @forelse($electricitys as $item)

            <flux:card
                wire:key="beneficiary-{{ $item['id'] }}"
                class="hover:shadow-md transition-all"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-semibold uppercase text-base">
                            {{ $item['biller_number'] }}
                        </h3>

                        <p class="text-sm text-zinc-500 mt-1">
                            {{ $item['biller_name'] }}
                        </p>

                    </div>

                    <div class="flex items-center gap-2">

                        <flux:button size="sm"
                            variant="ghost"
                            color="red"
                            wire:click="deleteBeneficiary({{ $item['id'] }})"
                            wire:confirm="Delete this beneficiary?"
                        >
                            <i class="fa fa-trash text-red-500"></i>
                        </flux:button>

                    </div>

                </div>

            </flux:card>

        @empty

            <flux:card>

                <div class="text-center py-10">

                    <div class="text-zinc-400 mb-2">
                        <i class="fa fa-users text-4xl"></i>
                    </div>

                    <p class="text-zinc-500">
                        No beneficiaries found.
                    </p>

                </div>

            </flux:card>

        @endforelse
    @else
    @endif
    </div>

</main>
</div>
   
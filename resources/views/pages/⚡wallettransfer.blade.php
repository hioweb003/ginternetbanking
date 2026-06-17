<?php

use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Wallet Transfer'])] class extends Component
{
   public $token;
      public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;   

    public string $accountName;
    public string $accountnumber;
    public int $amount;
    public string $narration;
    public $transpin=['','','',''];
    public $showamount = false;
    public $showpin = false;
    public int $fee;
    public int $totalamt;
    public string $reference;
    public string $source_account;

    public $wbeneficiaries=[];
    public string $typedamount;
    public int $step = 1;
    public $recenttrnx = [];
    public $accounts = [];

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

         $this->accounts = session('accounts-balance')['accounts'];
    }

       public function GetBalance($accounts){

            //   $response = Http::withHeaders([
            //         "content-type" => "application/json",
            //         "Authorization" => "Bearer ".$this->token
            //     ])->get(config('services.api.base_url')."customers/customer/get-balance");

            //     // Log::info("balance",$response["data"]);

            //     if (!$response->successful()) {
            //             // API failed
            //             $this->accounts = [];

            //         $this->dispatch('notify',
            //             type: 'error',
            //             message: "Unable to fetch balance at the moment",
            //             position: 'center',
            //             timer:3000,
            //             button:false
            //         );

            //             return;
            //         }
                  
               //$this->accounts = $response["data"] ?? [];
             //  $this->accounts = $accounts;
        }

    #[On('balance-loaded')]      
    public function updateBalance($data = [])
    {
         Log::info('balance updated',$data['data'] ?? []);

        session()->put("accounts-balance",[
                "accounts" => $data['data'] ?? []
            ]);
    }


     public function updatedTypedamount($value)
    {
        $this->amount = floatval(str_replace(',', '', $value));
    } 
    
    public function nextstep()
    {
        $this->step++;
    } 
     public function prevstep()
    {
        $this->step--;
    }

    #[Computed(persist: true, seconds: 1800)]
     public function GetBeneficiaryBanks(){

        $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->get(config('services.api.base_url').'customers/get-beneficiary');


        if($response['status'] == true){
                   $this->wbeneficiaries = $response['walletdata'] ?? [];
        }else{
          
             $this->dispatch('notify', 
                    title: 'Error',
                    message: 'Failed to fetch beneficiary banks. Please try again later.',
                    type: 'error'
                );
        }
    }

    #[Computed(persist: true, seconds: 1800)]
    public function GetRecentTransactions(){

        $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->get(config('services.api.base_url').'transactions/get-recent-transactions?transaction_type=wallet');


        if($response['status'] == true){
                  $this->recenttrnx = $response['data'] ?? [];
        }else{
                            
            $this->dispatch('notify', 
                    title: 'Error',
                    message: 'Failed to fetch recent transaction. Please try again later.',
                    type: 'error'
                );
        }
    }


    public function selectBeneficiary($accountnumber){
        $this->accountnumber = $accountnumber;
        $this->updatedAccountnumber();
    }

    public function selectRecentTransaction($accountnumber){

         $this->accountnumber = $accountnumber;

         $this->updatedAccountnumber();

    }
    
     public function updatedAccountnumber()
    {
        $this->accountName = '';
        $this->showamount = false;
        

        if(strlen($this->accountnumber) == 10){

            $response = Http::withHeaders([
                "content-type" => "application/json",
                "Authorization" => "Bearer ".$this->token
            ])->post(config('services.api.base_url')."transactions/verify-wallet-account",[
                "account_number" => $this->accountnumber,
                "institution_code" => $this->institution_code,
            ])->json();

     if(isset($response['code']) && $response['code'] == '401'){
                auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

            if($response["status"] == true){
                $this->showamount = true;
                $this->accountName = $response["data"]["first_name"]." ".$response["data"]["last_name"] ?? "";
            }else{
              
            $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed verify account. Please try again later.",
                    type: 'error'
                );
            }
        }
    }

    public function closeModal($modalname){
        Flux::modal($modalname)->close();
    }


    public function AccountTodebitTransfer(){
        
        Flux::modal('selectdebitacct')->show();
    }

   public function InitiateTransfer(){
  

      $this->validate([
            "amount" => "required|numeric|min:1|gt:0",
            "source_account" => "required"
      ]);

       $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url').'transactions/wallet/initiate-transaction',[
            "amount" => $this->amount,
            "description" => $this->narration,
            "platform" => "web",
             "institution_code" => $this->institution_code,
             "source_account" => $this->source_account,
       ])->json();
   
        if(isset($response['code']) && $response['code'] == '401'){
                auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){

            $this->reference = $response["data"]["transaction_reference"];
            $this->fee = $response["data"]["charge"];
            $this->totalamt = $this->amount + $this->fee;

                 $this->closeModal('selectdebitacct');
               $this->step++;
        }else{
         
          $this->closeModal('confirmpin');

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to initiate transfer. Please try again later.",
                    type: 'error'
                );
        }
           
        
    }

 public function ComfirmTransferPin(){

        Flux::modal('confirmpin')->show();

    }


    public function MakeTransfer(){

      $this->validate([
            "transpin.*" => "required|numeric|digits:1"
      ]);

        $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url').'transactions/wallet-transfer',[
            "amount" => $this->amount,
            "destination_account" => $this->accountnumber,
             "transaction_reference" => $this->reference,
             "receipient_name" => $this->accountName,
             "transaction_pin" => implode("", $this->transpin),
             "description" => $this->narration,
             "platform" => "web",
             "institution_code" => $this->institution_code,
             "source_account" => $this->source_account,
       ])->json();

    if(isset($response['code']) && $response['code'] == '401'){
                auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){

                $this->closeModal('confirmpin');

                  $this->dispatch('balance-refresh');

                  $exterra = [
                    'ref' => $this->reference,
                    'bankcode' => "",
                    'bankname' => $this->institution_fullname,
                    'accountno' => $this->accountnumber,
                    'accountname' => $this->accountName,
                    'type' => 'WalletTransfer',
                    'is_benfi' => true
                 ];

                return $this->redirectRoute('transfer-success',['institution' => $this->institution_name,'data' => Crypt::encrypt($exterra),'ty' => 'transfer'],navigate:true);
        }else{

        $this->closeModal('confirmpin');

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to complete transfer. Please try again later.",
                    type: 'error'
                );

        }


    }
};
?>

<div>
    <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
             <div class="md:hidden">
                 <div class="flex my-3 justify-center">
                    <flux:button href="{{ route('banktransfer',['institution' => $institution_name]) }}" wire:navigate.hover  variant="ghost">
                           Bank Transfer
                        </flux:button>
                        <flux:button href="#" variant="outline">
                           To Wallet
                        </flux:button>
                 </div>
            </div>

            <flux:card class="space-y-6 mx-auto mt-8 w-full max-w-md lg:max-w-xl">

    <div>
        <flux:heading size="lg">
                 <flux:button size="sm" href="{{ route('dashboard',['institution' => $institution_name]) }}"  wire:navigate.hover icon="arrow-left" variant="outline" inset />
        </flux:heading>
    </div>
    

    <div class="space-y-6">
          
               @if ($step == 1)
                   
        <flux:input label="Account Number" autocomplete='off' wire:model.live.debounce.700ms="accountnumber" placeholder="Your account number" />
            {{-- <flux:icon.loading wire:loading wire:target="accountnumber" class="text-black dark:text-white float-right my-2" /> --}}

        <flux:text class="text-green-500 dark:text-green-400 text-center text-base space-y-4">{{$accountName}}</flux:text>

         <div class="space-y-2">
                 <flux:button style="background-color: {{ $institution_color }}" wire:show='showamount' wire:click="nextstep" class="w-full cursor-pointer">Continue</flux:button>
            </div>

            
                <div x-data="{ tab: 'recettrnx' }" class="w-full">

                    <div class="flex justify-center space-x-2 bg-gray-100 dark:bg-gray-800 p-1 rounded-lg">

                        <button 
                            @click="tab = 'recettrnx'"
                             :class="tab === 'recettrnx' 
                                    ? 'bg-white text-black dark:bg-gray-900 shadow dark:text-white' 
                                    : 'text-black dark:text-white'"
                                class="px-4 py-2 rounded-lg transition">
                            Recent Transactions
                        </button>

                        <button 
                            @click="tab = 'beneficy'"
                            :class="tab === 'beneficy' 
                                    ? 'bg-white text-black dark:bg-gray-900 shadow dark:text-white' 
                                    : 'text-black dark:text-white'"
                                class="px-4 py-2 rounded-lg transition">
                            Beneficiary
                        </button>

                    </div>

                    <div class="mt-4">
                        <div x-show="tab === 'recettrnx'" wire:init='GetRecentTransactions'>
                            <div class="max-h-72 overflow-y-auto space-y-2 pr-1">
                              @foreach ($recenttrnx as $item)
                                  @if(!empty($item['accountNumber']))
                                    <div class="p-2 bg-white shadow-md dark:bg-gray-800 rounded hover:bg-zinc-100 hover:text-[#000000] cursor-pointer" wire:click="selectRecentTransaction('{{ $item['accountNumber'] }}')">
                                    <div class="flex items-center justify-between">

                                        <div>
                                        <flux:text class="text-sm text-gray-500">{{ucwords($item['accountNumber'])}}</flux:text>
                                        <flux:text class="text-sm text-gray-500">{{ucwords($item['accountName'])}}</flux:text>
                                    </div>
                                     
                                         <!-- Small Loader -->
                                        <div
                                            wire:loading.flex
                                            wire:target="selectRecentTransaction"
                                            class="items-center"
                                        >
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div>
                                    </div>
                                    </div>
                                    @endif
                                @endforeach
                             </div>
                        </div>
                        <div x-show="tab === 'beneficy'" wire:init='GetBeneficiaryBanks'>
                            <div class="max-h-72 overflow-y-auto space-y-2 pr-1">
                              @foreach ($wbeneficiaries as $item)
                                <div class="p-2 bg-white shadow-md dark:bg-gray-800 rounded hover:bg-zinc-100 hover:text-[#16262f] cursor-pointer" wire:click="selectBeneficiary('{{ $item['account_number'] }}')">
                                     <div class="flex items-center justify-between">

                                        <div>
                                    <flux:text class="text-sm text-gray-500">{{ucwords($item['bank_name'])}} - {{ucwords($item['account_number'])}}</flux:text>
                                    <flux:text class="text-sm text-gray-500">{{ucwords($item['account_name'])}}</flux:text>
                                        </div>
                                     
                                         <!-- Small Loader -->
                                        <div
                                            wire:loading.flex
                                            wire:target="selectBeneficiary"
                                            class="items-center"
                                        >
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>

                </div>
               @endif

          @if ($step == 2)

              <div class="bg-gray-100 dark:bg-gray-500 text-black dark:text-white p-2 rounded shadow border-gray-300 mb-3">
                  <div class="flex">
                     <flux:icon.home class="space-y-2 my-3 size-8"/>
                      <div class="ml-3">
                          <flux:text class="text-sm font-bold">{{ucwords($accountName)}}</flux:text>
                    <div class="flex items-center space-x-2 mt-2">
                        <flux:text class="font-normal">{{ $accountnumber }}</flux:text>
                         <flux:separator vertical/>
                        <flux:text class="font-normal"> {{ ucwords($institution_fullname) }}</flux:text>
                    </div>
                      </div>
                  </div>
             </div>

              <div class="space-y-2 mb-2">
                        
                         <div x-data="{selectedamount: null,displayValue: @entangle('typedamount'),
                                                formatValue() {
                                    let n = parseFloat(this.displayValue.replace(/,/g, ''));
                                    if (!isNaN(n)) {
                                        this.displayValue = n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                    }
                                },
                                unformatValue() {
                                    this.displayValue = this.displayValue.replace(/,/g, '');
                                }
                         }">
                              <flux:input placeholder="Enter Amount" class="w-full my-2" type="text" autocomplete="off"  x-model="displayValue" @blur="formatValue()" @focus="unformatValue()" wire:model.live="typedamount" />
                                  <div class="grid grid-cols-3 gap-2">
                                    <flux:button type="button" @click="selectedamount = (1000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦1,000</flux:button>
                                    <flux:button type="button" @click="selectedamount = (5000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦5,000</flux:button>
                                    <flux:button type="button" @click="selectedamount = (9999).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦9,999</flux:button>
                                    <flux:button type="button" @click="selectedamount = (20000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦20,000</flux:button>
                                    <flux:button type="button" @click="selectedamount = (50000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦50,000</flux:button>
                                    <flux:button type="button" @click="selectedamount = (100000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦100,000</flux:button>
                                 </div>
                         </div>
         </div>

                 <flux:textarea rows="1" label="Narration" autocomplete='off' wire:model="narration" placeholder="Narration (optional)" />

          <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="AccountTodebitTransfer"  class="w-full cursor-pointer">Continue</flux:button>
             <flux:button  wire:click="prevstep" variant="filled" class="w-full cursor-pointer" :loading="false">Back</flux:button>

            </div>
          @endif

        @if ($step == 3)
            <flux:heading size="lg">
                    <flux:text class="text-center text-2xl">Confirm Details</flux:text>
            </flux:heading>

             <div class="space-y-6 rounded">
               <div class="flex justify-between items-center">
                <flux:text class="">From</flux:text>
                <flux:text class="font-semibold"></flux:text>
            </div>
             <div class="flex justify-between items-center">
                <flux:text class="">Bank</flux:text>
                <flux:text class="font-semibold">{{ucwords($institution_fullname)}}</flux:text>
            </div> 
            <div class="flex justify-between items-center">
                <flux:text class="">{{ucwords(session('details')['name'] ?? "")}}</flux:text>
                <flux:text class="font-semibold">{{$source_account}}</flux:text>
            </div>
            <flux:separator />

               <div class="flex justify-between items-center">
                <flux:text class="">To</flux:text>
                <flux:text class="font-semibold"></flux:text>
            </div>
               <div class="flex justify-between items-center">
                <flux:text class="">Destination Bank</flux:text>
                <flux:text class="font-semibold"> {{ucwords($institution_fullname)}}</flux:text>
            </div>  
             <div class="flex justify-between items-center">
                <flux:text class="">{{ $accountName }}</flux:text>
                <flux:text class="font-semibold"> {{ $accountnumber }}</flux:text>
            </div>
            <flux:separator />

            <div class="flex justify-between items-center">
                <flux:text class="">Amount</flux:text>
                <flux:text class="font-semibold">₦{{ number_format($amount, 2) }}</flux:text>
            </div>
            <div class="flex justify-between items-center">
                <flux:text class="">Fee</flux:text>
                <flux:text class="font-semibold">₦{{ number_format($fee, 2) }}</flux:text>
            </div>  
            <div class="flex justify-between items-center">
                <flux:text class="">Total</flux:text>
                <flux:text class="font-semibold">₦{{ number_format($totalamt, 2) }}</flux:text>
            </div>
     
        </div>

           <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="ComfirmTransferPin"  class="w-full cursor-pointer">Transfer</flux:button>
             <flux:button  wire:click="prevstep" variant="filled" class="w-full cursor-pointer" :loading="false">Back</flux:button>

            </div>
          @endif
          
    </div>

   
</flux:card>



<flux:modal wire:ignore name="selectdebitacct" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Select Account To Debit</flux:heading>
            {{-- <flux:text class="mt-2">Make changes to your personal details.</flux:text> --}}
        </div>

        <div class="space-y-6 rounded">
            
                <flux:select size="sm" wire:model="source_account" placeholder="Select account to debit...">  
                     <flux:select.option value="">Select</flux:select.option>
                     @foreach ($accounts as $key => $item)
                          <flux:select.option value="{{ $item['account_number'] }}">{{ucwords($item['name'])." - ".$item['account_number'] }} ({{ number_format($item['balance'],2) }})</flux:select.option>
                       @endforeach
                </flux:select>

               <div class="flex justify-between items-center">
                     <flux:button  wire:click="closeModal('selectdebitacct')" variant="filled" class="w-full mx-1 cursor-pointer" :loading="false">Cancel</flux:button>

                  <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="InitiateTransfer"  class="w-full mx-1 cursor-pointer">Continue</flux:button>
            </div>
        </div>
    </div>
</flux:modal>

<flux:modal wire:ignore name="confirmpin" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Confirm Transaction</flux:heading>
        </div>
         
       

        <flex:text  class="text-gray-500 text-center">Transaction Pin</flex:text>
         <div x-data class="flex justify-center mt-4" id="inputs">
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.0" pattern="[0-9]*" inputmode="numeric" x-ref="p0"  @input="$refs.p1.focus()" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.1" pattern="[0-9]*" inputmode="numeric" x-ref="p1"  @input="$refs.p2.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.1', '');$refs.p0.focus();} else {$event.target.value = '';$wire.set('transpin.1', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.2" pattern="[0-9]*" inputmode="numeric" x-ref="p2"  @input="$refs.p3.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.2', '');$refs.p1.focus();} else {$event.target.value = '';$wire.set('transpin.2', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.3" pattern="[0-9]*" inputmode="numeric" x-ref="p3"  @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.3', '');$refs.p2.focus();} else {$event.target.value = '';$wire.set('transpin.3', ''); }" class="mx-1 w-12 text-center" />
        </div>
         <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="MakeTransfer"  class="w-full cursor-pointer">Confirm</flux:button>
             <flux:button  wire:click="closeModal" variant="filled" class="w-full cursor-pointer" :loading="false">Cancel</flux:button>

            </div>   
         
    </div>
</flux:modal> 
        </main>
</div>

<script>
window.addEventListener('balance-refresh', async () => {
        let baseurl = "{{ config('services.api.base_url') }}";
        let token = "{{ $token }}";

    let response = await fetch(baseurl+'customers/customer/get-balance',{
           method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            }
    });
    let data = await response.json();

    // 🔥 IMPORTANT: send as ONE payload
    Livewire.dispatch('balance-loaded', data);

});
    //   let wallets = @json($wbeneficiaries);
    //   let banks = @json($beneficiaries);
    //   console.log(wallets);
  
    //     function renderWallets() {
    //         const list = document.getElementById('wbeneficiarylist');
    //         list.innerHTML = '';
    //         wallets.forEach(wallet => {
    //             const li = document.createElement('li');
    //             li.className = 'p-2 bg-white shadow-md dark:bg-[#16262f] rounded hover:bg-zinc-100 hover:text-[#16262f] cursor-pointer';
    //             li.textContent = ${wallet.name} - ${wallet.account_number} (${wallet.bank_name});
    //             li.onclick = () => {
    //                 @this.set('accountnumber', wallet.account_number);
    //                 @this.set('accountName', wallet.name);
    //                 // Close modal
    //                 document.querySelector('[data-modal-name="wallet-beneficiary"]').classList.remove('open');
    //             };
    //             list.appendChild(li);
    //         });
    //     }
    //     document.addEventListener('DOMContentLoaded', () => {
    //         renderWallets();
    //     });


 const inputs = document.getElementById('inputs');
  
  inputs.addEventListener('input', function (e) {
      const target = e.target;
      const digit = target.value;
  
      if (isNaN(digit) || digit.length > 1) {
          target.value = ""; // Clear if input is invalid
          return;
      }
  
      if (digit !== "") {
          const next = target.nextElementSibling;
          if (next && next.tagName === 'INPUT') {
              next.focus();
          }
      }
  });
  
  inputs.addEventListener('keydown', function (e) {
      const target = e.target;
      const key = e.key;
  
      if (key === "Backspace" || key === "Delete") {
          target.value = ""; // Clear the current input
          const prev = target.previousElementSibling;
          if (prev && prev.tagName === 'INPUT') {
              prev.focus();
          }
          e.preventDefault(); // Prevent default deletion
      }
  });
   </script>
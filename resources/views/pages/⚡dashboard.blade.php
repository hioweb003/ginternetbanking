<?php

use Flux\Flux;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Dashboard'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;

    public bool $showBalance = false;
    public $accounts = [];

    public float $activeAccount = 0;

    public int $totalDebit;
    public int $totalCredit;
    public int $transactionCount;
    public $RecentTransactions =[];

    public function mount(){

        $this->institution_name = app('tenant')->name;
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

        $this->GetBalance();

        $this->GetDetails();

        $this->GetRecentTransactions();
    }

    public function closeModal($modalname){
        Flux::modal($modalname)->close();
    }

        public function toggleBalance()
        {
            $this->showBalance = !$this->showBalance;
        }

        public function setActiveAccount($index)
        {
            $this->activeAccount = $index;
        }

        public function getCurrentAccountProperty()
        {
            return $this->accounts[$this->activeAccount] ?? null;
        }

        public function GetBalance(){

              $response = Http::withHeaders([
                    "content-type" => "application/json",
                    "Authorization" => "Bearer ".$this->token
                ])->get(config('services.api.base_url')."customers/customer/get-balance");

                 //Log::info("balance",[isset($response['code']) && $response['code'] == '401']);

                if (!$response->successful()) {
                        // API failed
                        $this->accounts = [];

                    // $this->dispatch('notify',
                    //     type: 'error',
                    //     message: "Unable to fetch balance at the moment",
                    //     position: 'center',
                    //     timer:3000,
                    //     button:false
                    // );
                        $this->dispatch('notify', 
                            title: 'Error',
                            message: "Unable to fetch balance at the moment",
                            type: 'error'
                        );

                        return;
                    }

                    if(isset($response['code']) && $response['code'] == '401'){
                        auth()->logout();
                            session()->flush();

                            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
                    }
                  
               $this->accounts = $response["data"] ?? [];
               $this->totalDebit = $response["debit"] ?? 0;
               $this->totalCredit = $response["credit"] ?? 0;

               $this->transactionCount = $this->totalCredit + $this->totalDebit;
          
                session()->put("accounts-balance",[
                    "accounts" => $this->accounts
                ]);
               //$this->dispatch('accounts-balance',accounts:$this->accounts);
        }

          public function GetDetails(){

              $response = Http::withHeaders([
                    "content-type" => "application/json",
                    "Authorization" => "Bearer ".$this->token
                ])->get(config('services.api.base_url')."customers/get-details");

                //  Log::info("user details",$response->json());

                if (!$response->successful()) {
                        // API failed
                    // $this->dispatch('notify',
                    //     type: 'error',
                    //     message: "Unable to customer details at the moment",
                    //     position: 'center',
                    //     timer:3000,
                    //     button:false
                    // );
                        $this->dispatch('notify', 
                            title: 'Error',
                            message: "Unable to fetch customer details at the moment",
                            type: 'error'
                        );

                        return;
                    }

                     if(isset($response['code']) && $response['code'] == '401'){
                        auth()->logout();
                            session()->flush();

                            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
                    }

            $response = $response->json();

               session()->put("details",[
                 "uuid" =>  $response["data"]["uuid"],
                "userid" => $response["data"]["userid"],
                "name" => !empty($response["data"]["business_name"]) ? $response["data"]["business_name"] : $response["data"]["first_name"]. " " . $response["data"]["middle_name"] . " " . $response["data"]["last_name"],
                "first_name" => $response["data"]["first_name"],
                "middle_name" => $response["data"]["middle_name"],
                "last_name" => $response["data"]["last_name"],
                "business_name" => $response["data"]["business_name"],
                "dob" => $response["data"]["dob"],
                "phone" => $response["data"]["phone"],
                "profilepic" => $response["data"]["profilepic"],
                "username" => $response["data"]["username"],
                "bvn" => $response["data"]["bvn"],
                "nin" => $response["data"]["nin"],
                "email" => $response["data"]["email"],
                "address" => $response["data"]["address"],
                "gender" => $response["data"]["sex"],
                "referral" => $response["data"]["referral"],
                "valid_id" => $response["data"]["valid_id"],
                "signature" => $response["data"]["signature"],
                "accountno" => $response["data"]["accountno"],
                "bank_name" => $response["data"]["bank_name"],
                "currency" => $response["data"]["currency"],
                "account_type" => $response["data"]["account_type"],
                "tier" => $response["data"]["tier"],
                "daily_limit" => $response["data"]["daily_limit"]
               ]);
        }
      
         #[Computed()]
        public function GetRecentTransactions(){

                $response = Http::withHeaders([
                          "content-type" => "application/json",
                         "Authorization" => "Bearer ".$this->token
                    ])->get(config('services.api.base_url')."customers/get-transactions",[
                        "perpage" => '5'
                    ])->json();

                 if(isset($response['code']) && $response['code'] == '401'){
                        auth()->logout();
                            session()->flush();

                            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
                    }

            $this->RecentTransactions = $response["data"]["allTrans"] ?? [];

        }
};
?>

<div>
     <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">

            <!-- Account Banner -->
            <div class="bg-linear-to-r text-white rounded-2xl shadow-xl transition duration-300"
                style="background: linear-gradient(to right, {{ $institution_color  }}, {{ $institution_colortwo }});">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-6">
                   
                   @island(lazy: true)

                        @placeholder
                            <div class="space-y-3 p-4">
                                 <div class="animate-pulse">
                                    <p class="h-4 bg-gray-300 rounded w-32"></p>
                                    <h2 class="h-6 bg-gray-300 rounded w-48 mt-2"></h2>
                                </div>

                                <div class="animate-pulse">
                                    <p class="h-4 bg-gray-300 rounded w-32"></p>
                                    <h2 class="h-6 bg-gray-300 rounded w-48 mt-2"></h2>
                                </div>

                                <div class="animate-pulse">
                                    <p class="h-4 bg-gray-300 rounded w-32"></p>
                                    <h2 class="h-6 bg-gray-300 rounded w-48 mt-2"></h2>
                                </div>
                            </div>
                        @endplaceholder

                        <div x-data="{ active: @entangle('activeAccount'),
                          nextAccount() {
                                this.active = (this.active + 1) % $wire.accounts.length;
                                $wire.setActiveAccount(this.active);
                            },

                            prevAccount() {
                                this.active = (this.active - 1 + $wire.accounts.length) % $wire.accounts.length;
                                $wire.setActiveAccount(this.active);
                            }
                        }" class="relative">

                            <template x-for="(account, index) in $wire.accounts" :key="index">
                                <div x-show="active === index" x-transition class="p-4">

                                    <p class="text-sm opacity-80">Account Name</p>
                                    <h2 class="text-sm md:text-2xl font-semibold" x-text="account.name"></h2>

                                    <p class="text-sm opacity-80">Account Number</p>
                                    <h2 class="text-lg font-bold tracking-widest" x-text="account.account_number"></h2>

                                    <p class="mt-4 text-sm opacity-80">Available Balance</p>
                                    <div class="flex items-center space-x-3">
                                        <h1 class="text-2xl md:text-2xl font-bold">
                                            <span x-text="$wire.showBalance 
                                                ? '₦ ' + Number(account.balance).toLocaleString('en-NG',{ minimumFractionDigits: 2 }) 
                                                : '***********'">
                                            </span>
                                        </h1>

                                        <button wire:click.prevent="toggleBalance()" class="text-white/80 hover:text-white transition">
                                            <i class="fa" :class="$wire.showBalance ? 'fa-eye-slash' : 'fa-eye'"></i>
                                        </button>
                                    </div>

                                </div>
                            </template>

                            <div x-show="$wire.accounts.length > 1" class="flex justify-between mt-4 mx-3">

                                <button @click="prevAccount()"
                                    class="px-3 py-1 bg-[{{ $institution_color }}] text-white rounded shadow-lg">
                                    <
                                </button>

                                <button @click="nextAccount()"
                                    class="px-3 py-1 bg-[{{ $institution_color }}] text-white rounded shadow-lg">
                                    >
                                </button>

                            </div>

                        </div>

                    @endisland

                    <div class="text-right">
                        <div class="flex justify-end mx-2 my-2 md:mx-4 md:my-4">
                            <div class="bg-white/20 px-4 py-2 rounded-lg backdrop-blur-md">
                               <small class="font-normal text-center">{{ucwords(session('details')["tier"] ?? "")}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
        <div class="hidden md:block">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass p-5 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 dark:text-gray-400">Total Credit</p>
                    <h2 class="text-2xl font-bold text-green-500">₦ {{ number_format($this->currentAccount['total_credit'] ?? 0, 2) }}</h2>
                </div>
                <div class="glass p-5 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 dark:text-gray-400">Total Debit</p>
                    <h2 class="text-2xl font-bold text-red-500">₦ {{ number_format($this->currentAccount['total_debit'] ?? 0, 2) }}</h2>
                </div>
                <div class="glass p-5 rounded-xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 dark:text-gray-400">Total Transaction Amount</p>
                    @php
                       $tottransaction = ($this->currentAccount['total_credit'] ?? 0) + ($this->currentAccount['total_debit'] ?? 0);
                    @endphp
                    <h2 class="text-2xl font-bold text-indigo-500">{{ number_format($tottransaction,2) }}</h2>
                </div>
            </div>
        </div>

     <div class="md:hidden grid grid-cols-3 sm:grid-cols-4 gap-3">

            <!-- Item -->
             <a href="{{ route('banktransfer',['institution' => $institution_name]) }}" wire:navigate.hover>
                <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">

                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-wallet text-black dark:text-white text-lg"></i>
                </div>

                <span class="text-sm text-black dark:text-white whitespace-nowrap">To Other Bank</span>
            </div>
            </a>
            
            <a href="{{ route('wallettransfer',['institution' => $institution_name]) }}" wire:navigate.hover>
                <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">

                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-exchange text-black dark:text-white text-lg"></i>
                </div>

                <span class="text-sm text-black dark:text-white whitespace-nowrap">Wallet Transfer</span>
            </div>
            </a>

             <!-- Item -->
            <a href="{{ route('airtime',['institution' => $institution_name]) }}" wire:navigate.hover>
            <div  class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-signal text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Airtime</span>
            </div>
            </a>

             <!-- Item -->
         <a href="{{ route('buydata',['institution' => $institution_name]) }}" wire:navigate.hover >
                   <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-wifi text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Buy Data</span>
            </div>
        </a>

            <!-- Item -->
            <a href="{{ route('cabletv',['institution' => $institution_name]) }}" wire:navigate.hover>
            <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-television text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Cable TV</span>
            </div>
            </a>


            <!-- Item -->
            <a href="{{ route('electy',['institution' => $institution_name]) }}" wire:navigate.hover>
                 <div class="bg-white dark:bg-gray-800 dark:hover:bg-gray-800 transition rounded-xl p-2 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center mb-2">
                    <i class="fa fa-lightbulb text-black dark:text-white text-lg"></i>
                </div>
                <span class="text-sm text-black dark:text-white whitespace-nowrap">Electricity</span>
            </div>
            </a>

            {{-- <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-futbol text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300">Sports</span>
            </div>
             <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-piggy-bank text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300">Savings</span>
            </div>

            <!-- Item -->
            <div class="bg-gray-900 hover:bg-gray-800 transition rounded-xl p-4 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-orange-900 flex items-center justify-center mb-2">
                    <i class="fa fa-hand-holding-usd text-orange-400 text-lg"></i>
                </div>
                <span class="text-sm text-gray-300">Loan</span>
            </div> --}}

        </div>

          <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <div class="flex justify-between">
                <h2 class="text-sm font-normal mb-4 text-gray-700 dark:text-gray-200">Recent Transactions</h2>
                <h3 class="text-sm font-normal mb-4 text-gray-700 dark:text-gray-200">
                    <a href="{{ route('trxshity',['institution' => $institution_name]) }}">See All</a>
                </h3>
            </div>
               <div class="md:block hidden w-full">

                <table class="w-full text-sm">

                    <!-- Hide header on mobile -->
                    <thead class="hidden md:table-header-group">
                        <tr class="text-left text-gray-500 dark:text-gray-400 border-b">
                            <th class="py-2 px-3">Date</th>
                            <th class="px-3">Narration</th>
                            <th class="px-3">Type</th>
                            <th class="px-3">Amt</th>
                            <th class="px-3">Status</th>
                            <th class="px-3 text-center sm:hidden">View</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 dark:text-gray-200">
                            @island(lazy: true)
                              
                             @placeholder
                                <tr class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0 animate-pulse">

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div>
                                            <div class="bg-gray-300 h-4 w-24 rounded"></div>
                                            <div class="bg-gray-200 h-3 w-16 rounded mt-1"></div>
                                        </div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-32 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-16 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-24 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-200 h-6 w-20 rounded-full"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell text-right md:text-center">
                                        <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                    </td>

                                </tr>
                                 <tr class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0 animate-pulse">

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div>
                                            <div class="bg-gray-300 h-4 w-24 rounded"></div>
                                            <div class="bg-gray-200 h-3 w-16 rounded mt-1"></div>
                                        </div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-32 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-16 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-300 h-4 w-24 rounded"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell">
                                        <div class="bg-gray-200 h-6 w-20 rounded-full"></div>
                                    </td>

                                    <td class="px-3 py-1 flex justify-between md:table-cell text-right md:text-center">
                                        <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                    </td>

                                </tr>

                            @endplaceholder
                          @forelse ($RecentTransactions as $item)
                                
                                  <!-- Row -->
                        <tr class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0">

                            <td class="px-3 py-1 flex justify-between md:table-cell">
                                <span class="font-semibold md:hidden">Date</span>
                                <div>
                                    <div>{{date("d M Y",strtotime($item['created_at']))}}</div>
                                    <div class="text-xs text-gray-500">{{date("H:ia",strtotime($item['created_at']))}}</div>
                                </div>
                            </td>

                            <td class="px-3 py-1 flex justify-between md:table-cell">
                                <span class="font-semibold md:hidden">Description</span>
                                {{ $item['notes'] }}
                            </td>

                            <td class="px-3 py-1 flex justify-between md:table-cell {{$item['type'] == 'credit' || $item['type'] == 'deposit' ? 'text-green-500' : 'text-red-500'}}">
                                <span class="font-semibold md:hidden">Type</span>
                                {{ $item['type'] }}
                            </td>

                            <td class="px-3 py-1 flex justify-between md:table-cell">
                                <span class="font-semibold md:hidden">Amount</span>
                                ₦{{ number_format($item['amount'],2) }}
                            </td>

                            <td class="px-3 py-1 flex justify-between md:table-cell">
                                <span class="font-semibold md:hidden">Status</span>
                                <span class="px-3 py-1 text-xs rounded-full {{$item["status"] == "approved" ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'}}">
                                    {{ $item["status"] == "approved" ? 'Successful' : $item["status"]}} 
                                </span>
                            </td>

                            <td class="px-3 py-1 flex justify-between md:table-cell text-right md:text-center">
                                <span class="font-semibold md:hidden">View</span>
                                <a href="{{ route('trxreceipt',['institution' => $institution_name,'ref' => Crypt::encryptString($item['reference_no'])]) }}" wire:navigate.hover class="dark:text-white text-gray-600 hover:scale-110 transition">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>

                        </tr>

                            @empty
                                <tr class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0">

                                    <td colspan="6" class="px-3 py-1 text-center text-gray-500 dark:text-gray-400">
                                        No transactions found.
                                    </td>

                                </tr>
                            @endforelse
                            @endisland
                      
                    </tbody>
                </table>
                </div>

                {{-- mobile version --}}
                <div class="md:hidden space-y-3">
                <!-- Card -->
                <div class="bg-white dark:bg-gray-800 text-white rounded-xl p-4 shadow">

                    @island(lazy: true)
                              
                             @placeholder
                                 <div class="flex items-start justify-between animate-pulse">

                                    <!-- Left -->
                                    <div class="flex gap-3">

                                        <!-- Icon -->
                                        {{-- {{ $t->type=='Credit'?'fa-arrow-down text-green-400':'fa-arrow-up text-red-400' }} --}}
                                        <div class="w-10 h-10 rounded-full bg-green-900 flex items-center justify-center">
                                            <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                        </div>

                                        <!-- Title -->
                                        <div>
                                            <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                            <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                        </div>

                                    </div>

                                    <!-- Amount -->
                                    <div class="text-right">
                                    <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                        <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                    </div>

                                </div>
                                 <!-- Divider -->
                                    <div class="border-t border-gray-700 dark:border-white my-3"></div>

                                    <!-- Narration -->
                                    <div class="text-sm text-gray-600 dark:text-white">
                                         <div class="bg-gray-300 h-5 w-5 rounded-full"></div>
                                    </div>

                            @endplaceholder
                                    

                             @forelse ($RecentTransactions as $mitem)
                                    <a href="{{ route('trxreceipt',['institution' => $institution_name,'ref' => Crypt::encryptString($mitem['reference_no'])]) }}" wire:navigate.hover>

                                        <div class="flex items-start justify-between">

                                    <!-- Left -->
                                    <div class="flex gap-3">

                                        <!-- Icon -->
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $mitem['type'] == 'credit' || $mitem['type'] == 'deposit' ? 'bg-green-900' : 'bg-red-900' }}">
                                            <i class="fa {{ $mitem['type'] == 'credit' || $mitem['type'] == 'deposit' ? 'fa-arrow-down text-green-400' : 'fa-arrow-up text-red-400' }}"></i>
                                        </div>

                                        <!-- Title -->
                                        <div>
                                            <div class="font-semibold {{ $mitem['type'] == 'credit' || $mitem['type'] == 'deposit' ? 'text-green-400' : 'text-red-400' }}">{{ $mitem['type'] }}</div>
                                            <div class="text-sm text-gray-600 dark:text-white">{{ $mitem["status"] == "approved" ? 'Successful' : $mitem["status"]}} </div>
                                        </div>

                                    </div>

                                    <!-- Amount -->
                                    <div class="text-right">
                                        <div class="font-semibold {{ $mitem['type'] == 'credit' || $mitem['type'] == 'deposit' ? 'text-green-400' : 'text-red-400' }}">{{ $mitem['type'] == 'credit' || $mitem['type'] == 'deposit' ? '+' : '-' }} ₦ {{ number_format($mitem['amount'],2) }}</div>
                                        <div class="text-xs text-gray-600 dark:text-white">{{date("M,d Y",strtotime($mitem['created_at']))}}, {{date("H:ia",strtotime($mitem['created_at']))}}</div>
                                    </div>

                                </div>

                                  <!-- Narration -->
                                <div class="text-sm text-gray-600 dark:text-white mt-2">
                                     {{ $mitem['notes'] }}
                                </div>
                                <!-- Divider -->
                                <div class="border-t border-gray-700 dark:border-white my-2"></div>

                                    </a>
                             @empty
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-10">
                                            No transactions found.
                                        </div>
                            @endforelse
                          
                            @endisland

                   

                </div>

            </div>
        </div>

        </main>
</div>
<?php

use Flux\Flux;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Transaction history'])] class extends Component
{

    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
    
    public $Transactions =[];
    public $Tranxlinks =[];
    public string $search;
    public bool $is_loading = false;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?int $currentPage;
    public $shwgbtn = false;
    public bool $hasMorePages = true;

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

        $this->LoadTransactions();

    }

public function LoadTransactions($page = 1,$append = false){


                $response = Http::withHeaders([
                          "content-type" => "application/json",
                         "Authorization" => "Bearer ".$this->token
                    ])->get(config('services.api.base_url')."transactions/get-transaction-history?page=".$page)->json();

                 if(isset($response['code']) && $response['code'] == '401'){
                        auth()->logout();
                            session()->flush();

                            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
                    }

                    // dd($response["data"]["links"]);
            $this->currentPage = $response["data"]["current_page"] ?? 1;
           $transactions = $response["data"]["data"] ?? [];

             if ($append) {

                    $this->Transactions = collect(
                        array_merge($this->Transactions, $transactions)
                    )
                    ->unique('id') // Prevent duplicates
                    ->values()
                    ->toArray();

                } else {

                    $this->Transactions = $transactions;

                }

            $this->Tranxlinks = $response["data"]["links"] ?? [];

            $this->hasMorePages = ($response["data"]["current_page"] ?? 1) <  ($response["data"]["last_page"] ?? 1);

        }

    public function Paginationpage($page){

        if($this->start_date && $this->end_date){
                 $this->GenerateReport($page,false);
             }else{
                $this->LoadTransactions($page,false);
             }
        } 
        
        public function GenerateReport($page = 1,$append = false){
            
                  $resp = Http::withHeaders([
                          "content-type" => "application/json",
                         "Authorization" => "Bearer ".$this->token
                    ])->get(config('services.api.base_url')."transactions/get-transaction-statement",[
                        'fromdate' => $this->start_date,
                        'todate' => $this->end_date,
                        'page' => $page
                    ])->json();

                 if(isset($resp['code']) && $resp['code'] == '401'){
                        auth()->logout();
                            session()->flush();

                            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
                    }

             $this->currentPage = $resp["data"]["current_page"] ?? 1;
            $transactions = $resp["data"]["data"] ?? [];

              if ($append) {

                    $this->Transactions = collect(
                        array_merge($this->Transactions, $transactions)
                    )
                    ->unique('id') // Prevent duplicates
                    ->values()
                    ->toArray();

                } else {

                    $this->Transactions = $transactions;

                }
             $this->Tranxlinks = $resp["data"]["links"] ?? [];

             $this->hasMorePages = ($resp["data"]["current_page"] ?? 1) <  ($resp["data"]["last_page"] ?? 1);

        }

public function DownloadStatement($type){
            
             $url = $type == 'pdf' ? config('services.api.base_url')."transactions/download-transaction-statementviapdf" : config('services.api.base_url')."transactions/download-transaction-statementviacsv";
            
              $resp = Http::withHeaders([
                          "content-type" => "application/json",
                         "Authorization" => "Bearer ".$this->token
                    ])->get($url,[
                        'fromdate' => $this->start_date,
                        'todate' => $this->end_date, 
                    ])->json();


        if(isset($resp['code']) && $resp['code'] == '401'){
                auth()->logout();
                    session()->flush();

                    return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
            }


        $downloadtype = $type == 'pdf' ? 'application/pdf,' : 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
       
        if($resp["status"] == true){ 

                  $base64 = $resp["data"];

                if (str_contains($base64, 'base64,')) {
                    [$meta, $base64] = explode(',', $base64, 2);
                }

                $fileContent = base64_decode($base64);

                $filename = $type == 'pdf' ? ucwords(session('details')['name'] ?? "").'_statement.pdf' : ucwords(session('details')['name'] ?? "").'_statement.xlsx';

                return response()->streamDownload(function () use ($fileContent) {
                        echo $fileContent;
                    },
                    $filename,
                    [
                        'Content-Type' => $downloadtype,
                    ]
                );
           // return response()->download($downloadtype.''.$resp["data"]);

        }
    }

    public function loadMore()
    {// for mobile view
         $page = $this->currentPage + 1;

        //  dd($page);
       if($this->start_date && $this->end_date){
            $this->GenerateReport($page,true);
        } else {
            $this->LoadTransactions($page,true);
        }
    }

     public function OpenDownload($typ){
           $typ == "download" ?  $this->shwgbtn = false : $this->shwgbtn = true;
          Flux::modal('downloadstatmentbtn')->show();
    } 
    
    public function RestetFilters(){
         return $this->redirectRoute('trxshity',['institution' => $this->institution_name],navigate:true);
    }
};
?>

<div>
     <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1 pb-24 lg:pb-6">

               
                    <div class="md:block hidden">
                         <div class="flex items-end gap-4">

                        <flux:input
                            type="date"
                            label="Start Date"
                            wire:model="start_date"
                            class="flex-1"
                            required
                        />

                        <flux:input
                            type="date"
                            label="End Date"
                            wire:model="end_date"
                            class="flex-1"
                             required
                        />

                        <flux:button
                            style="color: white; background-color: {{ $institution_color }}"
                            wire:click="GenerateReport"
                            size="sm"
                            class="min-w-[120px] cursor-pointer"
                        >
                            Filter
                        </flux:button>

                        <flux:button
                            wire:click="RestetFilters"
                            variant="primary" color="red"
                            size="sm"
                            class="min-w-[120px] cursor-pointer"
                        >
                            Reset
                        </flux:button>
                        
                        
                        <flux:button
                            wire:click="OpenDownload('download')"
                            variant="filled"
                            size="sm"
                            class="min-w-[120px] cursor-pointer"
                           
                        >
                            Download
                        </flux:button>

                    </div>
                    </div>
                   

                      <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">

                    <h3 class="text-md font-normal text-gray-700 dark:text-gray-200">
                        Transactions History
                    </h3>

                    <div class="sm:w-64">
                        {{-- <flux:input
                            size="sm"
                            placeholder="Filter by..."
                            wire:model.live.debounce.500ms="search"
                        /> --}}
                       <div class="md:hidden">
                           <div class="flex justify-center gap-4">
                                <flux:button
                            style="color: white; background-color: {{ $institution_color }}"
                            wire:click="OpenDownload('filter')"
                            size="sm"
                            class="min-w-[120px] cursor-pointer"
                            
                        >
                            Filter
                        </flux:button>
                        <flux:button
                            wire:click="OpenDownload('download')"
                            variant="filled"
                            size="sm"
                            class="min-w-[120px] cursor-pointer"
                           
                        >
                            Download
                        </flux:button>
                           </div>
                       </div>
                    </div>

                </div>
               <div class="md:block hidden w-full">

                <table class="w-full text-sm">

                    <!-- Hide header on mobile -->
                    <thead class="hidden md:table-header-group border-b">
                            <th class="py-2 px-3" align="left">Sn</th>
                            <th class="py-2 px-3" align="left">Date</th>
                            <th class="px-3" align="left">Narration</th>
                            <th class="px-3" align="left">Type</th>
                            <th class="px-3" align="left">Amount</th>
                            <th class="px-3" align="left">Status</th>
                            <th class="px-3 text-center sm:hidden">View</th>
                    </thead>


                    <tbody class="text-gray-700 dark:text-gray-200">
                               
                                @php
                                    $i =0;
                                @endphp

                            @forelse ($Transactions as $index => $item)
                                    
                                    <!-- Row -->
                            <tr wire:key="transaction-{{ $index }}" class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0">

                                <td class="px-3 py-1 flex justify-between md:table-cell">
                                    <span class="font-semibold md:hidden">Sn</span>
                                    <div>
                                        <div>{{$i+1}}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-1 flex justify-between md:table-cell">
                                    <span class="font-semibold md:hidden">Date</span>
                                    <div>
                                        <div>{{date("d M Y",strtotime($item['created_at']))}}</div>
                                        <div class="text-xs text-gray-500">{{date("H:ia",strtotime($item['created_at']))}}</div>
                                    </div>
                                </td>

                                <td class="px-3 py-1 flex justify-between md:table-cell">
                                    <span class="font-semibold md:hidden">Description</span>
                                    {!! $item['notes'] !!}
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
                                    @php
                                        $i++;
                                    @endphp
                                @empty
                                    <tr class="border-b md:table-row block bg-white dark:bg-gray-800 md:bg-transparent rounded-xl md:rounded-none mb-3 md:mb-0 p-3 md:p-0">

                                        <td colspan="6" class="px-3 py-1 text-center text-gray-500 dark:text-gray-400">
                                            No transactions found.
                                        </td>

                                    </tr>
                                @endforelse

                    </tbody>
                </table>
                @if (!empty($Transactions))
                 
                    <div class="flex justify-end mt-2">
                         @foreach ($Tranxlinks as $link)
                                @if (!is_null($link['url']))
                                     @php
                                          if ($link["label"] === 'Next &raquo;') {
                                            $page = $this->currentPage + 1;
                                        } elseif ($link["label"] === '&laquo; Previous') {
                                            $page = max(1, $this->currentPage - 1);
                                        } else {
                                            $page = $link['label'];
                                        }
                                     @endphp
                                     <flux:button
                                            wire:click.prevent="Paginationpage('{{  $page  }}')"
                                            class="px-1 py-1 mt-5  text-sm rounded mx-1 cursor-pointer"   
                                            size="sm"  @disabled(!$link['url'])
                                            variant="{{ $link['active'] ? 'primary' : 'filled' }}">
                                        {!! $link["label"] !!}
                                    </flux:button>
                                @endif
                         
                       @endforeach
                       </div>
                @endif
                 
                </div>

                {{-- mobile version --}}
                <div class="md:hidden space-y-3">
                <!-- Card -->
                <div class="bg-white dark:bg-gray-800 text-white rounded-xl p-4 shadow">

                             @forelse ($Transactions as $mitem)
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

                            @if($hasMorePages)
                                    <div class="flex justify-center">
                                         <flux:button
                                        style="color: white; background-color: {{ $institution_color }}"
                                        wire:click="loadMore"
                                        size="sm"
                                        class="min-w-[120px] cursor-pointer"
                                        
                                    >
                                        Load More
                                    </flux:button>
                                    </div>
                            @endif
                       
                </div>

            </div>
        </div>

  


    <flux:modal wire:ignore name="downloadstatmentbtn" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg" wire:show='shwgbtn'>Filter Transactions</flux:heading>
            <flux:heading size="lg" wire:show='!shwgbtn'>Download Statement</flux:heading>

        </div>
         
       <div class="flex items-end gap-4">

                        <flux:input
                            type="date"
                            label="Start Date"
                            wire:model="start_date"
                            class="flex-1"
                             required
                        />

                        <flux:input
                            type="date"
                            label="End Date"
                            wire:model="end_date"
                            class="flex-1"
                             required
                        />

                    </div>
                         <flux:button wire:show='shwgbtn'
                            style="color: white; background-color: {{ $institution_color }}"
                            wire:click="GenerateReport"
                            size="sm"
                            class="w-full cursor-pointer"
                        >
                            Filter
                        </flux:button>
         <div wire:show='!shwgbtn'>
            <div class="flex justify-between items-center">
                <flux:button  wire:click="DownloadStatement('csv')"variant="primary" color="emerald"  class="w-full cursor-pointer mx-1" >Download CSV</flux:button>
             <flux:button  wire:click="DownloadStatement('pdf')" variant="primary" color="red" class="w-full cursor-pointer mx-1">Download PDF</flux:button>

            </div>   
        </div> 
         
    </div>
</flux:modal>

    </main>
</div>
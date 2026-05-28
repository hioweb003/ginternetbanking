<?php

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Download Statement'])] class extends Component
{

    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;

     public ?string $start_date = null;
    public ?string $end_date = null;

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
};
?>

<div>
  <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
               <!-- Header -->
    <div class="flex items-center gap-3">
        <flux:button href="{{ route('userprofile', ['institution' => $institution_name]) }}" icon="arrow-left" variant="ghost" wire:navigate />
        <flux:heading size="xl">Download Statement</flux:heading>
    </div>
    
                <flux:card class="space-y-6 mx-auto mt-8 w-full max-w-md lg:max-w-xl">

                    <div class="space-y-6">
                        <div class="flex justify-center gap-5">

                        <flux:input
                            type="date"
                            label="Start Date"
                            wire:model="start_date"
                            class="w-full"
                             required
                        />

                        <flux:input
                            type="date"
                            label="End Date"
                            wire:model="end_date"
                            class="w-full"
                             required
                        />

                    </div>
                    

                        <div class="flex justify-center items-center gap-2">
                            <flux:button  wire:click="DownloadStatement('csv')"variant="primary" color="emerald"  class="md:w-50 w-full cursor-pointer" >Download CSV</flux:button>
                        <flux:button  wire:click="DownloadStatement('pdf')" variant="primary" color="red" class="md:w-50 w-full cursor-pointer">Download PDF</flux:button>

                        </div>   
                 </div>
            </flux:card>

        </main>
</div>
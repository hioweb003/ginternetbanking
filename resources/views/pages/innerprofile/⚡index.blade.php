<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'User Profile'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  

    public string $profile_photo;
    public string $account_number;
    public string $account_name;
    public string $username;
    public string $email;
    public string $phone;
    public string $dob;
    public string $gender;
    public string $referral;
    public string $address;
    public string $nin;
    public string $bvn;

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

        $this->profile_photo = session('details')['profilepic'] ?? asset('img/userface.jpg');
        $this->account_number = session('details')['accountno'] ?? 'N/A';
        $this->account_name = session('details')['name'] ?? 'N/A';
        $this->username = session('details')['username'] ?? 'N/A';
        $this->email = session('details')['email'] ?? 'N/A';
        $this->phone = session('details')['phone'] ?? 'N/A';
        $this->dob = session('details')['dob'] ?? 'N/A';
        $this->gender = session('details')['gender'] ?? 'N/A';
        $this->address = session('details')['address'] ?? 'N/A';
        $this->nin = session('details')['nin'] ?? 'N/A';
        $this->bvn = session('details')['bvn'] ?? 'N/A';

    }
};
?>

<div>
        <!-- Content -->
<main class="p-2 md:p-4 space-y-6 flex-1">

    <!-- Header -->
    <div class="flex items-center gap-3">
        <flux:button href="{{ route('userprofile', ['institution' => $institution_name]) }}" icon="arrow-left" variant="ghost" wire:navigate.hover />
        <flux:heading size="xl">Profile Details</flux:heading>
    </div>

    <!-- Profile Section -->
    <div class="relative">

        <!-- Profile Image -->
        <div class="flex justify-center">
            <div class="relative">
                <img
                    src="{{ $profile_photo }}"
                    alt="Profile"
                    class="w-28 h-28 rounded-full border-4 border-white shadow-lg object-cover"
                >
            </div>
        </div>

        <!-- Account Summary -->
        <flux:card class="mt-[-20px] pt-12">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-zinc-500">Account Number</p>
                    <p class="font-semibold text-lg">
                        {{ $account_number }}
                    </p>
                </div>

                <div class="md:text-right">
                    <p class="text-sm text-zinc-500">Account Name</p>
                    <p class="font-semibold text-lg uppercase">
                        {{ $account_name }}
                    </p>
                </div>

            </div>

        </flux:card>

    </div>

    <!-- Profile Information -->
    <flux:card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Username -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Username</p>
                <p class="font-medium">{{"@".$username }}</p>
            </div>

            <!-- Email -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Email Address</p>
                <p class="font-medium break-all">{{ $email }}</p>
            </div>

            <!-- Phone -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Phone Number</p>
                <p class="font-medium">{{ $phone }}</p>
            </div>

            <!-- DOB -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Date of Birth</p>
                <p class="font-medium">{{ date('d-m-Y', strtotime($dob)) }}</p>
            </div>

            <!-- Gender -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Gender</p>
                <p class="font-medium">{{ ucfirst($gender) }}</p>
            </div>
{{-- 
            <!-- Referral -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">Referral Code</p>
                <p class="font-medium">{{ $referral }}</p>
            </div> --}}

            <!-- Address -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2 md:col-span-2">
                <p class="text-xs text-zinc-500">Residential Address</p>
                <p class="font-medium">{{ $address }}</p>
            </div>

            <!-- NIN -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">NIN</p>
                <p class="font-medium">
                   {{$nin != 'N/A' ? '******' . substr($nin, -5) : 'N/A'}}
                </p>
            </div>

            <!-- BVN -->
            <div class="border border-gray-300 dark:border-gray-600 rounded p-2">
                <p class="text-xs text-zinc-500">BVN</p>
                <p class="font-medium">
                    {{$bvn != 'N/A' ? '******' . substr($bvn, -5) : 'N/A'}}
                </p>
            </div>

        </div>

    </flux:card>

</main>
</div>
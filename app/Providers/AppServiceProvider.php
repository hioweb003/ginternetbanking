<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Blaze\Blaze;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blaze::optimize()->in(resource_path('views/components'))
            ->in(resource_path('views/pages'))
            ->in(resource_path('views/livewire/auth'))
            ->in(resource_path('views/receipts'))
            ->in(resource_path('views/login-admin'));
    }
}

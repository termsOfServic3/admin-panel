<?php

namespace App\Providers;

use App\Policies\DomainPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Domain;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Domain::class, DomainPolicy::class);
    }
}
